<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Traits\SubcribeTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    use SubcribeTrait;
    public function subscribe(Request $request)
    {
        $request->validate([
            'subjects_ids' => 'required',
            'amount' => 'required',
            'bill_number' => 'required',
            'payment_method_id' =>'required'
        ]);
        $subjects = $this->subcribe(
                                    $request->subjects_ids , 
                                    $request->amount , 
                                    $request->bill_number , 
                                    $request->payment_method_id,
                                    Auth::user()->student,
                                    'pending'
                                    );
        return ResponseHelper::success($subjects, 'Subscribed successfully');
    }
}
