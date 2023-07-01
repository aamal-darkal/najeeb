<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class SubscriptionController extends Controller
{
    public function index()
    {
        $orders = Order::withCount('subjects')->has('payment')->with('payment')->get();
          //return $orders;
        return view('pages.subscriptions.index', compact('orders'));
    }

    public function getSubs()
    {
        $currentRoute = Route::currentRouteName();
        $orders = Order::whereHas('payment', function ($q) use ($currentRoute) {
            if ($currentRoute == 'subscriptions.approved')
                return $q->where('state', 'approved');
            elseif ($currentRoute == 'subscriptions.rejected')
                return $q->where('state', 'rejected');
            return $q->where('state', 'pending');
        })->with('student','payment')->withCount('subjects')->get();
        if($currentRoute == 'subscriptions.pending')
           // return $orders;
        return view('pages.subscriptions.requests', compact('orders'));
        //return $orders;
        return view('pages.subscriptions.index', compact('orders'));
    }

    public function changeStatus(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required',
            'ids' => 'required'
        ]);
        $status = $validated['status'];

        $orders = Order::whereIn('id', $validated['ids'])->with('payment','subjects.weekProg')->get();

        $orders->each(function($order) use ($status) {
            $order->payment()->update(['state' => $status]);
        });

        foreach ($orders as $order)
        {
            $ids = $order->subjects->pluck('id');
            $student = Student::find($order->student_id);
            $student->subjects()->attach($ids);
        }
        return redirect()->back();
    }
}
