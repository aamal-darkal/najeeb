<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MessagingHelper;
use App\Http\Helpers\NotificationHelper;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Student;
use App\Models\PaymentMethod;
use App\Models\Subject;
use App\Traits\SubcribeTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{

    use SubcribeTrait;

    public function index(Request $request)
    {
        $state = $request->input('state', 'current');

        $students = Student::where('state', $state)
            ->with('user')
            ->with('subjects')
            ->withCount('subjects')
            ->with('user')
            ->paginate(8);

        return view('pages.students.index', compact('students', 'state'));

        // if ($request->ajax()) {
        //     $packages = Package::withCount('subjects')->paginate(2);
        //     return view('pages.packages.index', compact('packages'))->render();
        // }       
    }

    public function search(Request $request)
    {
        $state = $request->input('state', 'current');
        $search = $request->input('search') ?? '';

        $students = Student::where('state', $state)
            ->where(function ($q) use ($search) {
                return $q->where('first_name', 'LIKE', "%$search%")
                    ->orWhere('last_name', 'LIKE', "%$search%");
            })
            ->with('user')
            ->with('subjects')
            ->withCount('subjects')
            ->paginate(8);

        return view('pages.students.index', compact('students', 'state', 'search'));
    }

    function create()
    {
        $paymentMethods = PaymentMethod::get();
        $subjects = Subject::with('package')->get();
        $packages = Package::with('subjects')->get();
        return view('pages.students.create', compact('paymentMethods', 'subjects', 'packages'));
    }

    /**
     * store new student with all details (order  , order-subect, payment , student-subject)
     *
     * @param StoreStudentRequest $request
     * @return void
     */
    public function store(StoreStudentRequest $request)
    {
        $validated = $request->validated();
        $subjectsIds =  $validated['subjects_ids'];
        $amount =  $validated['amount'];
        $bill_number =  $validated['bill_number'];
        $payment_method_id =  $validated['payment_method_id'];

        $subjects = Subject::find($subjectsIds);

        if ($amount < $subjects->sum('cost'))
            return back()->with('error', 'the amount you paid is less than the cost')->withInput();


        $student = Student::create($request->all());

        if (!$student)
            return back()->with('error', 'Student was not registered successfully');

        $order = $student->orders()->create(
            [
                'amount' => $amount,
            ]
        );

        foreach ($subjects as $subject) {
            $order->subjects()->attach($subject->id, ['cost' => $subject->cost]);
        }
        $order->payments()->create([
            'bill_number' => $bill_number,
            'amount' => $amount,
            'payment_method_id' => $payment_method_id,
            'start_duration_date' => $subjects->first()->package->start_date,
            'payment_date' => Carbon::now(), //should be given by app
            'state' => 'approved'
        ]);

        $student->subjects()->attach($subjectsIds);

        $this->createUser($student);

        return redirect()->route('students.index')->with('success', 'Student was registered successfully');
    }

    public function show(Student $student)
    {
        return view('pages.students.show', compact('student'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {

        foreach ($student->orders as $order) {
            foreach ($order->payments as $paymant)
                $paymant->delete();
            $order->delete();
        }

        $student->delete();

        $student->user()->delete();

        return redirect()->route('students.index')->with('success', "student deleted successfully");
    }

    /**
     * update many student
     * either thier state or token of thier account
     *
     * @param Request $request
     * @return void
     */
    function updateMany(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required',
            'ids' => 'required',
            'ids.*' => 'sometimes|exists:students,id'
        ]);

        // reset token of students
        if ($validated['action'] == 'reset-token') {
            $students = Student::with('user')->find($validated['ids']);
            foreach ($students as $student)
                $student->user->update(['token_birth' => null]);
            return back()->with('success', 'Studnet\'s token is reset successfully');;

            // ban students
        } else if (($validated['action'] == 'ban')) {
            $students = Student::find($validated['ids']);
            foreach ($students as $student)
                $student->update(['state' => 'banned']);
            return back()->with('success', 'Student is banned successfully');;
        } else if (($validated['action'] == 'unban')) {
            $students = Student::find($validated['ids']);
            foreach ($students as $student)
                $student->update(['state' => 'current']);
            return back()->with('success', 'Student is ubanned successfully');;
        }
    }

    /**
     * show edit view
     *
     * @param Student $student
     * @return void
     */
    public function edit(Student $student)
    {
        return view('pages.students.edit', compact('student'));
    }

    /**
     * update student
     *
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return void
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $validated = $request->validated();
        $student->user->update(['user_name' => $validated['user_name']]);
        $student->update($validated);

        return redirect()->route('students.show', $student)->with('success', 'Data updated successfully');
    }

    //****************************** password change  **************************************/
    /**
     * show input for password
     *
     * @param Student $student
     * @return void
     */
    public function passwordEdit(Student $student)
    {
        return view('pages.students.password', compact('student'));
    }
    /**
     * saved Entered password
     *
     * @param Request $request
     * @param Student $student
     * @return void
     */
    public function passwordUpdate(Request $request, Student $student)
    {
        $validated = $request->validate([
            'password' => 'required|min:6',
        ]);
        $newPassword = $validated['password'];
        $student->user->update(['password' => Hash::make($newPassword)]);

        $msg = "مرحباً $student->first_name لقد تم تغيير كلمة سر حسابك " . "\n" . " كلمة السر الجديدة : $newPassword";
        $to = $student->phone;

        (new MessagingHelper)->sendMessage($msg, $to);

        return redirect()->route('students.show', $student)->with('success', 'Password changed successfully');
    }
    //****************************** send notication change  **************************************/
    /**
     * show input for password
     *
     * @param Student $student
     * @return void
     */
    public function noticationCreate(Student $student)
    {
        return view('pages.students.notifcation', compact('student'));
    }
    /**
     * saved Entered password
     *
     * @param Request $request
     * @param Student $student
     * @return void
     */
    public function noticationStore(Request $request, Student $student)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:25',
            'description' => 'required|string|max:255',
            'time_publish' => 'required|date',
        ]);
        $validated['time_publish'] = Carbon::parse($validated['time_publish'])->format('Y-m-d H:i');
        $validated['created_at'] = now();
        
        $notification = Notification::create($validated);
        
        $student->notifications()->attach($notification);
        
        $token = $student->user->fcm_token;

        NotificationHelper::sendNotification( $notification , $token );
        
        return redirect()->route('students.show' , $student)->with('success', 'Notification has been sent successfully');

    }
    //************************************** subcribe *****************************************/

    public function subcribeEdit(Student $student)
    {
        $paymentMethods = PaymentMethod::get();
        $subjects = Subject::with('package')->get();
        $packages = Package::with('subjects')->get();
        return view('pages.students.subcribe', compact('paymentMethods', 'subjects', 'packages', 'student'));
    }

    public function subcribeUpdate(Request $request, Student $student)
    {
        $validated = $request->validate(
            [
                'subjects_ids' => ['required', 'array'],
                'subjects_ids.*' => ['required', 'exists:subjects,id'],
                'amount' => ['required', 'integer'],
                'bill_number' => ['nullable', 'digits_between:1,20'],
                'payment_method_id' => ['nullable', 'exists:App\Models\PaymentMethod,id'],
            ]
        );
        $subjectsIds =  $validated['subjects_ids'];
        $amount =  $validated['amount'];
        $bill_number =  $validated['bill_number'];
        $payment_method_id =  $validated['payment_method_id'];

        $subjects = Subject::find($subjectsIds);

        if ($amount < $subjects->sum('cost'))
            return back()->with('error', 'the amount you paid is less than the cost')->withInput();


        $order = $student->orders()->create(
            [
                'amount' => $amount,
            ]
        );

        foreach ($subjects as $subject) {
            $order->subjects()->attach($subject->id, ['cost' => $subject->cost]);
        }
        $order->payments()->create([
            'bill_number' => $bill_number,
            'amount' => $amount,
            'payment_method_id' => $payment_method_id,
            'start_duration_date' => $subjects->first()->package->start_date,
            'payment_date' => Carbon::now(), //should be given by app
            'state' => 'approved'
        ]);

        $student->subjects()->attach($subjectsIds);


        return redirect()->route('students.show', $student)->with('success', 'Student subcribe successfully');
    }
}
