<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MessagingHelper;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Models\User;
use App\Http\Controllers\Api\AuthController;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Subject;
use App\Traits\SubcribeTrait;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    use SubcribeTrait;

    public function index($status = null)
    {
        $students = Student::when($status, function ($query, $status) {
            return $query->where('state', $status);
        })
            ->withCount('subjects')
            ->with('user')
            ->get();
        return view('pages.students.index', compact('students', 'status'));
    }

    function create()
    {
        $paymentMethods = PaymentMethod::get();
        $subjects = Subject::with('package')->orderBy('package_id')->get();
        return view('pages.students.create', compact('paymentMethods', 'subjects'));
    }
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());

        if (!$student)
            return back()->with('error', 'Student was not registered successfully');

        $subjectsIds =  $request->subjects_ids;
        $result = $this->subcribe(
            $subjectsIds,
            $request->amount,
            $request->bill_number,
            $request->payment_method_id,
            $student,
            'approved'
        );
        if ($result['status'] = 'error')
            return back()->with('error', $result['msg']);

        $student->subjects()->attach($subjectsIds);

        $this->createUser($student);

        return back()->with('success', 'Student was registered successfully');
    }

    //****************************** functions for get info */

    public function search(Request $request)
    {
        $search = $request->search;
        $students = Student::when($search, function ($query) use ($search) {
            return $query->whereHas('user', function ($query) use ($search) {
                return $query->where('user_name', 'LIKE', "%$search%")->orWhere('last_name', 'LIKE', "%$search%");
            });
        })
            ->withCount('subjects')->with('subjects')->paginate(10);

        return view('pages.students.index', compact('students', 'search'));
    }

    public function fetchData(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $items = User::select('id', 'user_name')->has('student')->where('user_name', 'LIKE', "%$searchTerm%")->get();

        return response()->json($items);
    }

    public function getRequests()
    {
        $requests = Student::where('state', 'new')->latest()->get();
        return view('pages.students.requests', compact('requests'));
    }


    public function getStudentDetails($id)
    {
        $student = Student::with('subjects.package', 'lecturesAttended')->withCount('subjects', 'lecturesAttended')->find($id);
        return view('pages.students.details', compact('student'));
    }
    //********************** tasks for student */
    public function rejectStudent($id)
    {
        Student::find($id)->update(['state' => 'rejected']);

        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,current,rejected',
            'ids' => 'required'
        ]);
        $status = $validated['status'];
        if (is_int($validated['ids']))
            $validated['ids'] = array($validated['ids']);
        $students = Student::whereIn('id', $validated['ids'])->get();

        if ($status == 'rejected') {
            $students->each(function ($student) {
                $student->update(['state' => 'rejected']);
            });
        } else {
            //accepted
            $students->each(function ($student) {
                $this->createUser($student);
            });
        }
        back()->with('success', 'Opertaion done successfuly');
    }

    private function createUser($student)
    {
        //get username
        $usedUserName = true;
        while ($usedUserName) {
            $code = rand(111, 999);
            $userName = $student->first_name . '_' . $student->last_name . '_' . $code;
            $usedUserName = User::where('user_name', $userName)->exists();
        }
        $usedUserName = true;
        $password = Str::random(8);

        $user = $student->user()->create([
            'user_name' =>  $userName,
            'password' => Hash::make($password),
        ]);

        //change user status
        $student->update(['state' => 'current', 'user_id' => $user->id]);
        $msg = "مرحباً " . $student->first_name . " لقد تم تأكيد طلبكم لقد أصبح لديك حساب في تطبيق نجيب \n أسم المستخدم: " . $userName . " و كلمة السر : " . $password;
        $to = $student->phone;
        (new MessagingHelper)->sendMessage($msg, $to);
        event(new Registered($user));
    }


    public function resetTokenDate(Request $request)
    {
        $test = User::find($request->user_id)->update(['token_birth' => null]);
        return $test;
        return redirect()->back();
    }

    public function changePass(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'password' => 'required|min:6'
        ]);
        $newPassword = $request->password;
        $user = User::find($request->user_id);
        $user->update(['password' => Hash::make($newPassword)]);
        $student = Student::select('first_name', 'phone')->where('user_id', $user->id)->first();

        $msg = "مرحباً $student->first_name لقد تم تغيير كلمة سر حسابك " . "\n" . " كلمة السر الجديدة : $newPassword";
        $to = $student->phone;

        (new MessagingHelper)->sendMessage($msg, $to);

        return redirect()->back()->with('success', 'Password changed successfully');
    }
}
