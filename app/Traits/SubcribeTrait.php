<?php
namespace App\Traits ;

use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait SubcribeTrait {
    
    public function subcribe($subjects_ids , $amount , $bill_number , $payment_method_id , $student)
    {
        $subjects = Subject::find($subjects_ids);        
        if (!$subjects)
            return response()->json('These subjects does not exist');

        $totalCost = $subjects->sum('cost');

        if($totalCost > $amount)
            return response()->json('the amount you paid is less than the cost');

        $order = $student->orders()->create(
            [
                'amount' => $amount,
            ]
        );

        foreach ($subjects as $subject)
        {
            $order->subjects()->attach($subject->id,['cost' => $subject->cost]);
        }
        $order->payments()->create([
            'bill_number' => $bill_number,
            'amount' => $amount,
            'payment_method_id' => $payment_method_id,
            'start_duration_date' => $subjects->first()->package->start_date,
            'payment_date' => Carbon::now(), //should be given by app
        ]);
        return $subjects;
    }
    
}