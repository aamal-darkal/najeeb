<?php

namespace App\Traits;

use App\Http\Helpers\MessagingHelper;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait SubcribeTrait
{

    public function subcribe($subjects_ids, $amount, $bill_number, $payment_method_id, $student, $state)
    {
        $status = 'success';
        $message = '';
        $subjects = Subject::find($subjects_ids);

        if (!$subjects) {
            $status = 'error';
            $message = 'These subjects does not exist';
        }
        // return response()->json();

        $totalCost = $subjects->sum('cost');

        if ($totalCost > $amount) {
            $status = 'error';
            $message = 'the amount you paid is less than the cost';
        }
        // return response()->json('');

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
            'state' => $state
        ]);
        return [
            'status' => $status,
            'msg' => $message,
            'subjects' => $subjects
        ];
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

        //change user state
        $student->update(['state' => 'current', 'user_id' => $user->id]);
        $msg = "مرحباً " . $student->first_name . " لقد تم تأكيد طلبكم لقد أصبح لديك حساب في تطبيق نجيب \n أسم المستخدم: " . $userName . " و كلمة السر : " . $password;
        $to = $student->phone;
        (new MessagingHelper)->sendMessage($msg, $to);
        event(new Registered($user));
    }
}
