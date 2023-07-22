<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Traits\SubcribeTrait;
use Illuminate\Http\Request;


class SubscriptionController extends Controller
{
    use SubcribeTrait;
    public function index()
    {
        $payments = Payment::with('order.subjects', 'order.student')->with(['order' =>   function ($q) {
            return $q->withCount('subjects');
        }])->get();
        return view('pages.subscriptions.index', compact('payments'));
    }

    public function edit($status)
    {
        $payments = Payment::with('order.subjects', 'order.student')->with(['order' =>   function ($q) {
            return $q->withCount('subjects');
        }])->when($status == 'approved', function ($q) {
            return $q->where('state', 'approved');
        })->when($status == 'rejected', function ($q) {
            return $q->where('state', 'rejected');
        })->when($status == 'pending', function ($q) {
            return $q->where('state', 'pending');
        })->get();

        return view('pages.subscriptions.edit', compact('payments', 'status'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required',
            'ids' => 'required',
            'ids.*' => 'exists:payments,id'
        ]);
        $action = $validated['action'];
        $ids = $validated['ids'];

        //reject
        if ($action == 'reject') {
            $payments = payment::find($ids);
            foreach ($payments as $payment)
                $payment->update(['state' => 'rejected']);

            //unreject
        } else if ($action == 'unreject') {
            $payments = payment::find($ids);
            foreach ($payments as $payment)
                $payment->update(['state' => 'pending']);

            //  approve  
        } else if ($action == 'approve') {
            $payments = payment::with('order.student.user', 'order.subjects')->find($ids);
            foreach ($payments as $payment) {
                $payment->update(['state' => 'approved']);

                //create user
                $student = $payment->order->student;
                if (!$student->user)
                    $this->createUser($student);

                //attach subjects
                $subjects = $payment->order->subjects;
                $student->subjects()->attach($subjects);
            }
        } else if ($action == 'unapprove') {
            $payments = payment::with('order.student','order.subjects')->find($ids);
            foreach ($payments as $payment) {
                $payment->update(['state' => 'pending']);

                //create user
                $student = $payment->order->student;

                //attach subjects
                $subjects = $payment->order->subjects;
                $student->subjects()->detach($subjects);
            }
        }
        return back()->with('success', 'payments updated successfully');

    }

    
}
