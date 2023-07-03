<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MessagingHelper;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\User;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
{
    public function index($status = null)
    {
        $students = Student::when($status, function ($query, $status) {
            return $query->where('state', $status);
        })
            ->withCount('subjects')
            ->with('user')
            ->get();
        return view('pages.students.index',compact('students','status'));
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
        $student = Student::select('first_name','phone')->where('user_id', $user->id)->first();

        $msg = "مرحباً $student->first_name لقد تم تغيير كلمة سر حسابك "."\n"." كلمة السر الجديدة : $newPassword" ;
        $to = $student->phone ;

        (new MessagingHelper)->sendMessage($msg, $to);

        return redirect()->back()->with('success', 'Password changed successfully');
    }
    public function search(Request $request)
    {
        $search = $request->search ;
        $students = Student::when($search, function ($query) use ($search){
                return $query->whereHas('user',function($query) use ($search){
                    return $query->where('user_name','LIKE', "%$search%")->orWhere('last_name','LIKE', "%$search%");
                });
        })
            ->withCount('subjects')->with('subjects')->paginate(10);

        return view('pages.students.index',compact('students','search'));
    }

    public function fetchData(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $items = User::select('id','user_name')->has('student')->where('user_name', 'LIKE', "%$searchTerm%")->get();

        return response()->json($items);
    }

    public function getRequests()
    {
        $requests = Student::where('state','new')->latest()->get();
        return view('pages.students.requests',compact('requests'));
    }

    public function store(StoreStudentRequest $request)
    {
        $student = (new AuthController)->registerStudent($request);
        // $approveRequest = new Request(['ids' => $student->getData()->data->id,'status' => 'current']);
        // //$request->merge(['name' => 'John Doe']);
        // $this->changeStatus($approveRequest);
        // if($student->getStatusCode() == 401)
            // return redirect()->back()->with('error', 'Student was not registered');

        return redirect()->back()->with('success', 'Student was registered successfully');


    }

    public function getStudentDetails($id)
    {
        $student = Student::with('subjects.package','lecturesAttended')->withCount('subjects','lecturesAttended')->find($id);
        return view('pages.students.details',compact('student'));
    }

    public function rejectStudent($id)
    {
         Student::find($id)->update(['state'=>'rejected']);

        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required',
            'ids' => 'required'
                ]);
        $status = $validated['status'];
        if(is_int($validated['ids']))
            $validated['ids'] = array($validated['ids']);
        $students = Student::whereIn('id', $validated['ids'])->get();

        if ($status == 'rejected')
        {
            $students->each(function($student) use ($status) {
                $student->update(['state' => $status]);
            });
            return redirect()->back();
        }
        $students->each(function($student) use ($status) {
            $isUnique = true;
            while ($isUnique) {
                $code = rand(111,999);
                $userName = $student->first_name . '_' . $student->last_name . '_' . $code ;
                $isUnique = User::where('user_name', $userName)->exists();
            }
            $password = Str::random(8);

            $user = $student->user()->create([
                'user_name' =>  $userName,
                'password' => Hash::make($password),
            ]);
            $student->update(['state' => $status, 'user_id' => $user->id]);
            $msg = "مرحباً ". $student->first_name ." لقد تم تأكيد طلبكم لقد أصبح لديك حساب في تطبيق نجيب \n أسم المستخدم: ". $userName . " و كلمة السر : " . $password;
            $to = $student->phone ;

            (new MessagingHelper)->sendMessage($msg, $to);
            event(new Registered($user));
        });
        return redirect()->back();
    }
}
