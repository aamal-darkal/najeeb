<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class SubscriptionController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order', 'order.subjects', 'order.student')->get();
        return view('pages.subscriptions.index', compact('payments'));
    }

    public function getSubs()
    {
        $currentRoute = Route::currentRouteName();
        $payments = Payment::with('order', 'order.subjects', 'order.student')
            ->when($currentRoute == 'subscriptions.approved', function ($q) use ($currentRoute) {
                return $q->where('state', 'approved');
            })->when($currentRoute == 'subscriptions.rejected', function ($q) use ($currentRoute) {
                return $q->where('state', 'rejected');
            })->when($currentRoute == 'subscriptions.pending', function ($q) use ($currentRoute) {
                return $q->where('state', 'pending');
            })->get();


        if ($currentRoute == 'subscriptions.pending')
            // return $orders;
            return view('pages.subscriptions.requests', compact('payments'));
        //return $orders;
        return view('pages.subscriptions.index', compact('payments'));
    }

    public function changeStatus(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required',
            'ids' => 'required'
        ]);
        $status = $validated['status'];

        $payments = payment::with('order')->find($validated['ids']);
        foreach ($payments as $payment)
            $payment->update(['state' => $status]);

        if ($status == 'approved') {
            foreach ($payments as $payment) {
                $subjects = $payment->order->subjects;
                $student = Student::find($payment->order->student_id);
                $student->subjects()->attach($subjects);
            }
        }
        return redirect()->back();
    }
}
