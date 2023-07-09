<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationHelper;
use App\Models\Notification;
use App\Models\Student;
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
        $validated = $request->all();
        // return $validated;
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'title' => 'required|string|max:25',
            'description' => 'required|string|max:255',
            'time_publish' => 'required',
        ]);
        $validated['time_publish'] = Carbon::parse($validated['time_publish'])->format('Y-m-d H:i');
        $validated['created_at'] = now();
        $notification = Notification::create($validated);

        if ($request->user_id)
            NotificationHelper::userNotification($validated['user_id'], $notification);
        else
        {
            NotificationHelper::broadcastNotification($notification );
        }
        return back()->with('success', 'Notification has been sent successfully');
    }
}
