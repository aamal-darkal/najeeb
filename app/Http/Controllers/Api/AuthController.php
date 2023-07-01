<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserInfoResource;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerStudent(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        return response()->json([
            'data' => $student,
            'message' => 'registered successfully'
        ]);
    }

    public function login(Request $request){
        $request['user_name'] = $request->username;
        if (!Auth::attempt($request->only('user_name', 'password'))) {
            return response()->json([
                'message' => 'Login information is invalid.'
            ], 401);
        }

        $user = User::where('user_name', $request['user_name'])->firstOrFail();
        if($user->token_birth && Carbon::make($user->token_birth)->diffInDays(Carbon::now()) <= 30)
            return response()->json([
                'message' => 'You are not allowed to login, Your last login was within the last 30 days.'
            ], 401);

        $user->update(['fcm_token' => $request->fcm_token, 'token_birth' => Carbon::now()]);
        $token = $user->createToken('authToken')->plainTextToken;
        $student = Student::where('user_id', $user->id)->first();
        $user['photo'] = null;
        $user['name'] = $student->first_name .' '. $student->last_name ;
        $user['phone'] = $student->phone;
        $user['token'] = $token;
        return response()->json([
            'status' => 200 ,
            'data' => $user,
        ]);
    }

    public function getUserInfo(Request $request)
    {
        $user = User::with('student')->find(Auth::id()) ;
        $user['token'] = $request->bearerToken();
        return new UserInfoResource($user) ;
    }

    public function myPayments()
    {
        $userId = Auth::id();
        $studentId = Student::where('user_id', $userId)->first()->id;
        $orderId = Order::where('student_id',$studentId)->latest()->first()->id;
        $payment = Payment::where('order_id',$orderId)->orderBy('payment_date','DESC')->first();
        return new PaymentResource($payment, $userId, $studentId);
    }

    public function registerAndSubscribe(Request $request)
    {
        $data['registerResponse'] = app('router')->prepareResponse(
            $request,
            app('router')->dispatch(
                app('router')->getRoutes()->match(
                    app('request')->create('/register', 'POST')
                )
            )
        );

        $data['subscribeResponse'] = app('router')->prepareResponse(
            $request,
            app('router')->dispatch(
                app('router')->getRoutes()->match(
                    app('request')->create('/subscribe', 'POST')
                )
            )
        );

        return response()->json([
            'status' => 200 ,
            'data' => $data,
        ]);
    }
}
