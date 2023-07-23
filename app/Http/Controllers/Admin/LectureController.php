<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationHelper;
use App\Http\Requests\StoreLectureRequest;
use App\Models\Lecture;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LectureController extends Controller
{
    public function index($subjectId = null)
    {
        $lectures = Lecture::join('week_programs', 'lectures.week_program_id', '=', 'week_programs.id')
            ->when($subjectId, function ($query, $subjectId) {
                return $query->where('week_programs.subject_id', $subjectId);
            })
            ->select('lectures.id', 'name as title', DB::raw("CONCAT(date,'T',week_programs.start_time) as start"), DB::raw("CONCAT(date,'T',week_programs.end_time) as end"))
            ->get(3);
        // return $lectures;
        $lectures->map(function ($lecture) {
            $lecture['color'] = $this->rndRGBColorCode(200);
            $lecture['url'] = route('lectures.show', $lecture->id);
            return $lecture;
        });

        foreach ($lectures as $lecture) {
            $newLectures[] = (string) $lecture;
        }

        if (isset($newLectures))
            $lectures = implode(',', $newLectures);
        else
            $lectures = null;
        return view('pages.lectures.index', compact('lectures'));
    }

    private function rndRGBColorCode($min = 0, $max = 255)
    {
        return 'rgb(' . rand($min, $max) . ',' . rand($min, $max) . ',' . rand($min, $max) . ')'; #using the inbuilt random function 
    }

    public function show(Lecture $lecture)
    {
        return view('pages.lectures.show', compact('lecture'));
    }
    public function create()
    {
        $packages = Package::with('subjects')->withCount('subjects')->get();
        return view('pages.lectures.create-step1', compact('packages'));
    }

    public function create2(Request $request)
    {
        $package_id =  $request->package_id;
        $package_name = $request->package_name;
        $subjects = Subject::where('package_id', $package_id)->with('weekProgs')->get();
        // return $subjects;
        return view('pages.lectures.create-step2', compact('subjects', 'package_name', 'package_id'));
    }

    public function create3(Request $request)
    {
        $package_id =  $request->package_id;
        $package_name = $request->package_name;
        $subject_name = $request->subject_name;
        $week_program_id = $request->week_program_id;
        // $allowedDays = Week_program::select('day' + 1)->find('week_program_id')->day;
        $allowedDates = DB::select('select day+0 as dayNum , day from week_programs where id= ?' , [$week_program_id]);
        $allowedDay = $allowedDates[0]->dayNum - 2;
        $allowedDayName = $allowedDates[0]->day;
        $denyDays = "[";
        for ($i= 0 ; $i < 7 ; $i++)
        {
            if ($i != $allowedDay)
                $denyDays.= "$i,";
        }

        $denyDays = substr($denyDays , 0 ,-1);
        $denyDays.= "]";

        
        $subject_id = $request->subject_id;
        return view('pages.lectures.create-step3', compact('package_name', 'package_id', 'subject_name', 'subject_id', 'week_program_id' , 'denyDays' , 'allowedDayName' ));
    }

    public function store(StoreLectureRequest $request)
    {        
        $validated = $request->validated();
        $validated['date'] = Carbon::parse($validated['date'])->format('Y-m-d H:i');

        $lecture = Lecture::create($validated);
        if ($request->has('pdf_files')) {
            $path = 'pdf/files';
            foreach ($request->file('pdf_files') as $pdf) {
                $filename = date('YmdHi') . $pdf->getClientOriginalName();
                $pdf->move(public_path($path), $filename);                
                $link_pdf = $path . '/' . $filename;            
                $lecture->pdfFiles()->create(['pdf_link' => $link_pdf, 'name' => '']);
            }
        }
        $notification = Notification::create(['title' => 'New Lecture', 'description' => "$lecture->name at $lecture->date", 'time_publish' => $validated['date'] , 'created_at'  => now()]);

        NotificationHelper::broadcastLectureNotification($validated['subject_id'], $notification );
        return redirect()->route('lectures.index')->with('success' , 'Lecture Saved successfuly');
    }

    public function destroy($lecture)
    {
        $lecture->delete();
        return redirect()->route('lectures.index');
    }   
}
