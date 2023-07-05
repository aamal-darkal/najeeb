<?php

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



//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'home'])->name('dashboard');
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'home'])->name('dashboard');
});
///////////////Student Routes////////////
Route::get('students/{status?}/{search?}',[\App\Http\Controllers\Admin\StudentController::class,'index'])->name('students');
Route::post('searched-students',[\App\Http\Controllers\Admin\StudentController::class,'search'])->name('search.students');
// Route::view('add-student','pages.students.create')->name('add.student');
Route::get('add-student',[\App\Http\Controllers\Admin\StudentController::class,'create'])->name('add.student');
Route::post('store-student',[\App\Http\Controllers\Admin\StudentController::class,'store'])->name('store.student');
Route::get('student-requests',[\App\Http\Controllers\Admin\StudentController::class,'getRequests'])->name('student-requests');
Route::get('student-details/{id}',[\App\Http\Controllers\Admin\StudentController::class,'getStudentDetails'])->name('student-details');
Route::post('change-student-status',[\App\Http\Controllers\Admin\StudentController::class,'changeStatus'])->name('change.students.status');
Route::view('change-student-password', 'pages.students.change-pass')->name('change.student.password');
Route::post('update-password',[\App\Http\Controllers\Admin\StudentController::class,'changePass'])->name('update.password');
Route::post('reset-token-date',[\App\Http\Controllers\Admin\StudentController::class,'resetTokenDate'])->name('reset.token.date');
Route::get('/fetch-data', [\App\Http\Controllers\Admin\StudentController::class,'fetchData'])->name('fetch.data');


///////////////Package Routes////////////
Route::get('packages',[\App\Http\Controllers\Admin\PackageController::class,'index'])->name('packages');
Route::post('show',[\App\Http\Controllers\Admin\PackageController::class,'show'])->name('package.show');
Route::get('paginated-packages',[\App\Http\Controllers\Admin\PackageController::class,'paginatedIndex'])->name('paginated.packages');
Route::view('create-package','pages.packages.create')->name('create-package');
Route::post('store-package',[\App\Http\Controllers\Admin\PackageController::class,'store'])->name('store-package');
Route::get('delete-package/{id}',[\App\Http\Controllers\Admin\PackageController::class,'destroy'])->name('delete.package');


///////////////Subject Routes////////////
Route::get('subjects',[\App\Http\Controllers\Admin\SubjectController::class,'index'])->name('subjects');
Route::get('subject-subscriptions',[\App\Http\Controllers\Admin\SubscriptionController::class,'getSubscribedStudents'])->name('subject.subscriptions');
Route::get('create-subject-step1',[\App\Http\Controllers\Admin\SubjectController::class,'create1'])->name('create.subject.step1');
Route::get('create-subject-step2',[\App\Http\Controllers\Admin\SubjectController::class,'create2'])->name('create.subject.step2');
Route::post('store-subject',[\App\Http\Controllers\Admin\SubjectController::class,'store'])->name('store-subject');
Route::get('delete-subject/{id}',[\App\Http\Controllers\Admin\SubjectController::class,'destroy'])->name('delete.subject');

///////////////Lecture Routes////////////
Route::get('lectures/{subjectId?}',[\App\Http\Controllers\Admin\LectureController::class,'index'])->name('lectures');
Route::get('lecture/{id}',[\App\Http\Controllers\Admin\LectureController::class,'show'])->name('lecture.show');
Route::get('create-lecture',[\App\Http\Controllers\Admin\LectureController::class,'create'])->name('create.lecture');
Route::post('create-lecture-step2',[\App\Http\Controllers\Admin\LectureController::class,'create2'])->name('create.lecture.step2');
Route::post('create-lecture-step3',[\App\Http\Controllers\Admin\LectureController::class,'create3'])->name('create.lecture.step3');
Route::post('store-lecture',[\App\Http\Controllers\Admin\LectureController::class,'store'])->name('store.lecture');
Route::get('delete-lecture/{id}',[\App\Http\Controllers\Admin\LectureController::class,'destroy'])->name('delete.lecture');

///////////////Notification Routes////////////
Route::view('Broadcast-notification', 'pages.notifications.create')->name('Broadcast.notification');
Route::view('send-user-notification', 'pages.notifications.user-notification-create')->name('send.user.notification');
Route::post('send-notification',[\App\Http\Controllers\NotificationController::class,'send'])->name('notification.send');

///////////////Subscription Routes////////////
Route::get('subscriptions',[\App\Http\Controllers\Admin\SubscriptionController::class,'index'])->name('subscriptions');
Route::get('subscriptions/approved',[\App\Http\Controllers\Admin\SubscriptionController::class,'getSubs'])->name('subscriptions.approved');
Route::get('subscriptions/rejected',[\App\Http\Controllers\Admin\SubscriptionController::class,'getSubs'])->name('subscriptions.rejected');
Route::get('subscriptions/pending',[\App\Http\Controllers\Admin\SubscriptionController::class,'getSubs'])->name('subscriptions.pending');
Route::post('change-subscriptions-status',[\App\Http\Controllers\Admin\SubscriptionController::class,'changeStatus'])->name('change.subscriptions.status');

