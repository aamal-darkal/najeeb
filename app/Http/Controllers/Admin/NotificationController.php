<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationHelper;
use App\Models\Notification;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    /**
     * view broadcast and student notification form
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request) {
        $search = $request->input('search' , false);
        $students = [];
        if($search)
            $students = Student::where('state' , 'current')->get();        


        return view('pages.notifications.create' , compact('students'))->with('search' , $search);
    }

    /**
     * store broadcast and student notification 
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_ids' => 'sometimes|array',
            'student_ids.*' => 'sometimes|exists:students,id',
            'title' => 'required|string|max:25',
            'description' => 'required|string|max:255',
            'time_publish' => 'required|date',
        ]);
        $validated['time_publish'] = Carbon::parse($validated['time_publish'])->format('Y-m-d H:i');
        $validated['created_at'] = now();
        
        $notification = Notification::create($validated);
        // $studentIds = [];
        $tokens = [];
        if(empty($validated['student_ids'])) {
            $students = Student::where('state' , 'current')->get() ;
            $studentIds =  $students->pluck('id');
        }
        else {
            $students = Student::wherein('id', $validated['student_ids'])->get() ;
            $studentIds = $validated['student_ids'];
        }
        
        foreach ($students as $student)
            $student->notifications()->attach($notification->id);
        
        $tokens = User::select('fcm_token')->whereHas('student',function($q) use ($studentIds) {
            $q->wherein('id' , $studentIds);
        })->get();

        NotificationHelper::sendNotification( $notification , $tokens );
        
        return back()->with('success', 'Notification has been sent successfully');
    }
}
