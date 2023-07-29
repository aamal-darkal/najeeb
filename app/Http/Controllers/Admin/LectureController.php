<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationHelper;
use App\Http\Requests\StoreLectureRequest;
use App\Models\Lecture;
use App\Models\Notification;
use App\Models\Package;
use App\Models\PdfFile;
use App\Models\Subject;
use App\Models\WeekProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LectureController extends Controller
{

    // public function index1(Request $request)
    // {
    //     $subject = $request->subject;
    //     $subjects = Subject::when($subject , function($q) use ($subject) {
    //         return $q->where('id' , $subject);
    //     })->with('package','weekProgs')->withCount('students')->get();
    //     return view('pages.subjects.index',compact('subjects'));
    // }

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

    /*******************************************
     * three create steps
     ************************************/
    public function show(Lecture $lecture)
    {
        return view('pages.lectures.show', compact('lecture'));
    }


    public function create(Request $request)
    {
        $week_program_id = $request->week_program_id;
        $week_program = WeekProgram::find($week_program_id);
        $subject_id = $request->subject_id;
        $subject = Subject::find($week_program->subject_id);

        // get denied days
        $allowedDates = DB::select('select day+0 as dayNum , day from week_programs where id= ?', [$week_program_id]);
        $allowedDay = $allowedDates[0]->dayNum - 2;
        $allowedDayName = $allowedDates[0]->day;
        $denyDays = "[";
        for ($i = 0; $i < 7; $i++) {
            if ($i != $allowedDay)
                $denyDays .= "$i,";
        }
        $denyDays = substr($denyDays, 0, -1);
        $denyDays .= "]";

        return view('pages.lectures.create', compact( 'subject', 'week_program_id','denyDays' ,'allowedDayName'));
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
        $notification = Notification::create(['title' => 'New Lecture', 'description' => "$lecture->name at $lecture->date", 'time_publish' => $validated['date'], 'created_at'  => now()]);

        NotificationHelper::broadcastLectureNotification($validated['subject_id'], $notification);
        return redirect()->route('lectures.index')->with('success', 'Lecture Saved successfuly');
    }
    /**
     * Undocumented function
     *
     * @param Lecture $lecture
     * @return void
     */
    public function destroy(Lecture $lecture)
    {
        $lecture->delete();
        //!!!!!!!!!!!!!!!! delete files
        return back()->with('success', 'file deleted successfuly');
    }

    /**
     * Undocumented function
     *
     * @param [type] $pdfFile
     * @return void
     */
    public function destroyPdf(PdfFile $pdfFile)
    {
        $link_pdf = $pdfFile->link_pdf;
        $pdfFile->delete();
        // delete link_pdf  //!!!!!!!!!!!!!!!!!!!!!!!!!/
        return back()->with('success', 'file deleted successfuly');
    }
}
