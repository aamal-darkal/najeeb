<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    /***************************************  profile *********************************/
    Route::resource('profile' , ProfileController::class)->only('edit','update');

    /***************************************  dashboard *********************************/
    Route::get('/', [DashboardController::class, 'home'])->name('dashboard');

    /***************************************  Students *********************************/
    Route::controller(StudentController::class)->group(function () {
        Route::get('students-password/{student}', 'passwordEdit')->name('students.password-edit');
        Route::post('students-password/{student}', 'subcribeCreate')->name('students.password-update');
        Route::get('students-notification/{student}', 'noticationCreate')->name('students.notification-create');
        Route::post('students-notification/{student}', 'noticationStore')->name('students.notification-store');
        Route::get('students-subcribe/{student}', 'subcribeEdit')->name('students.subcribe-edit');
        Route::post('students-subcribe/{student}', 'subcribeUpdate')->name('students.subcribe-update');
        Route::post('student/update-many/',  'updateMany')->name('students.update-many');
        Route::get('students-search', 'search')->name('students.search');
    });
    Route::resource('students', StudentController::class);

    /***************************************  Packages *********************************/
    Route::get('paginated-packages', [PackageController::class, 'paginatedIndex'])->name('paginated.packages');
    Route::resource('packages', PackageController::class);


    /***************************************  Subjects *********************************/
    Route::controller(SubjectController::class)->group(function () {
        Route::get('subjects/create-step2',  'create2')->name('subjects.create.step2');
    });
    Route::resource('subjects', SubjectController::class);

    /***************************************  lectures *********************************/
    Route::controller(LectureController::class)->group(function () {
        Route::get('lectures/create-step2',  'create2')->name('lectures.create.step2');
        Route::get('lectures/create-step3',  'create3')->name('lectures.create.step3');
    });
    Route::resource('lectures', LectureController::class);

    /***************************************  notification *********************************/
    Route::resource('notifications', NotificationController::class)->only('create', 'store');

    /***************************************  Subscription *********************************/
    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('subscriptions', 'index')->name('subscriptions.index');
        Route::get('subscriptions/edit/{status}', 'edit')->name('subscriptions.edit');
        Route::post('subscriptions/update', 'update')->name('subscriptions.update');
    });
});
