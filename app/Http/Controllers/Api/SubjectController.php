<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Models\Order;
use App\Models\Student;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Monolog\toArray;

class SubjectController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required',
            'amount' => 'required',
            'bill_number' => 'required',
            'payment_method_id' =>'required'
        ]);
        $ids = json_decode($validated['ids']);

        $subjects = Subject::find($ids);
        if (!$subjects)
            return response()->json('These subjects does not exist');

        $totalCost = $subjects->sum('cost');

        if($totalCost > $validated['amount'])
            return response()->json('the amount you paid is less than the cost');

        $order = Auth::user()->student->orders()->create(
            [
                'amount' => $validated['amount'],
            ]
        );
        foreach ($subjects as $subject)
        {
            $order->subjects()->attach($subject->id,['cost' => $subject->cost]);
        }
        $order->payment()->create([
            'bill_number' => $validated['bill_number'],
            'amount' => $validated['amount'],
            'payment_method_id' => $validated['payment_method_id'],
            'start_duration_date' => Carbon::now(),
            'payment_date' => Carbon::now(),
        ]);

        return ResponseHelper::success($subjects, 'Subscribed successfully');
    }
}
