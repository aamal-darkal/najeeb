<?php

namespace App\Traits;

use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
}
