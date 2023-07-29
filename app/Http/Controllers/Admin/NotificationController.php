<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationHelper;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Student;
use App\Models\Subject;
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
    public function create(Request $request)
    {
        $package = $request->input('package');
        $subject = $request->input('subject');

        $students = Student::select('id')->when(
            $package,
            function ($q) use ($package) {
                return $q->wherehas('subjects', function ($q) use ($package) {
                    return $q->where("package_id", $package);
                });
            }

        )->when($subject, function ($q) use ($subject) {
            return $q->wherehas('subjects', function ($q) use ($subject) {
                return $q->where('students.id', $subject);
            });
        })->where('state', 'current')->get()->pluck('id');
        if ($package)
            $package = Package::find($package);
        if ($subject)
            $subject = Subject::find($subject);
        return view('pages.notifications.create', compact('students', 'package', 'subject'));
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
            'title' => 'required|string|max:25',
            'description' => 'required|string|max:255',
            'time_publish' => 'required|date',
        ]);
        $validated['time_publish'] = Carbon::parse($validated['time_publish'])->format('Y-m-d H:i');
        $validated['created_at'] = now();

        $package = $request->input('package');
        $subject = $request->input('subject');

        $notification = Notification::create($validated);

        $tokens = [];
        $students = Student::where('state', 'current')
            ->when(
                $package,
                function ($q) use ($package) {
                    return $q->wherehas('subjects', function ($q) use ($package) {
                        return $q->where('package_id', $package);
                    });
                }
            )
            ->when($subject, function ($q) use ($subject) {
                return $q->wherehas('subjects', function ($q) use ($subject) {
                    return $q->where('subject_id', $subject);
                });
            })
            ->get();
        $studentIds =  $students->pluck('id');

        foreach ($students as $student)
            $student->notifications()->attach($notification->id);

        $tokens = User::select('fcm_token')->whereHas('student', function ($q) use ($studentIds) {
            $q->wherein('id', $studentIds);
        })->get();

        NotificationHelper::sendNotification($notification, $tokens);

        if ($package)
            return redirect()->route('packages.index')->with('success', 'Notification has been sent successfully');

        else if ($subject)
            return redirect()->route('packages.show' , ['package' => Subject::find( $subject)->package_id])->with('success', 'Notification has been sent successfully');

        return back()->with('success', 'Notification has been sent successfully');
    }
}
