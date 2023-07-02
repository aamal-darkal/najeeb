<?php

use App\Http\Controllers\Api\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('my_public_classes', [\App\Http\Controllers\Api\PackageController::class, "getPublicSubjects"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [\App\Http\Controllers\Api\AuthController::class, "getUserInfo"]);
    Route::get('my_payments',[\App\Http\Controllers\Api\AuthController::class,'myPayments']);
    Route::post('student/ClasseOrderCreate' , [\App\Http\Controllers\Api\AuthController::class,'registerAndSubscribe']);


    Route::get('my_classes', [\App\Http\Controllers\Api\PackageController::class, "getSubjects"]);    
    Route::get('my_class', [\App\Http\Controllers\Api\PackageController::class, "getMySubjects"]);

    Route::get('/my_notifications_all', [NotificationController::class, 'index']);
    Route::get('/my_notifications_unseen', [NotificationController::class, 'unseen']);
    Route::post('/my_notifications', [NotificationController::class, 'see']);
    
    Route::get('time_table',[\App\Http\Controllers\Api\LectureController::class,'timeTable']);
    Route::get('lecture/{id}',[\App\Http\Controllers\Api\LectureController::class,'show']);
    
    Route::get('attend/{id}' , [\App\Http\Controllers\Api\AttendeeController::class,'attend']);
    
    Route::post('class_order_create' , [\App\Http\Controllers\Api\SubjectController::class,'subscribe']);

});

Route::post('register',[\App\Http\Controllers\Api\AuthController::class,'registerStudent']);
Route::post('login',[\App\Http\Controllers\Api\AuthController::class,'login']);

Route::get('test',[App\Http\Controllers\Admin\SubscriptionController::class, 'getSubs']);
Route::post('reset-token',[\App\Http\Controllers\Admin\StudentController::class,'resetTokenDate']);

