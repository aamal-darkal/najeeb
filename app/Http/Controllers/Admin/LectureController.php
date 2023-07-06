<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLectureRequest;
use App\Models\Lecture;
use App\Models\Package;
use App\Models\Subject;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LectureController extends Controller
{
    use ImageTrait;
    public function index($subjectId = null)
    {
        $lectures = Lecture::join('week_programs', 'lectures.week_program_id' , '=' ,'week_programs.id')
            ->when($subjectId, function ($query, $subjectId) {
                return $query->where('week_programs.subject_id', $subjectId);
            })
            ->select('lectures.id', 'name as title', DB::raw("CONCAT(date,'T',week_programs.start_time) as start"), DB::raw("CONCAT(date,'T',week_programs.end_time) as end"))
            ->get(3);
            // return $lectures;
        $lectures->map(function ($lecture) {    
            $lecture['color'] = $this->rndRGBColorCode(200);
            $lecture['url'] = route('lecture.show', $lecture->id);
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

    private function rndRGBColorCode($min =0 , $max=255)
    {
        return 'rgb(' . rand($min, $max) . ',' . rand($min, $max) . ',' . rand($min, $max) . ')'; #using the inbuilt random function 
    }

    public function show($id){
        $lecture = Lecture::with('pdfFiles')->find($id);
        return view('pages.lectures.show',compact('lecture'));
    }
    public function create()
    {
        $packages = Package::with('subjects')->withCount('subjects')->get();
        return view('pages.lectures.create-step1',compact('packages'));
    }

    public function create2(Request $request)
    {

        $package_name = $request->package_name;
        $subjects = Subject::where('package_id', $request->package_id)->with('weekProgs')->get();
        // return $subjects;
        return view('pages.lectures.create-step2',compact('subjects','package_name'));
    }

    public function create3(Request $request)
    {
        $package_name = $request->package_name;
        $subject_name = $request->subject_name;
        $week_program_id = $request->week_program_id;
        $subject_id = $request->subject_id ;
        return view('pages.lectures.create-step3',compact('package_name', 'subject_name', 'subject_id', 'week_program_id'));
    }

    public function store(StoreLectureRequest $request)
    {

        $data = $request->validated();
        $lecture = Lecture::create($data);
        if($request->has('pdf_file'))
        {
                $path = 'pdf/files' ;
                $pdf = $this->uploadImage( $request->file('pdf_file'),$path);
                $data['link_pdf'] = $path.'/'. $pdf;

            $lecture->pdfFiles()->create(['pdf_link' => $data['link_pdf'], 'name' => $data['pdf_file_name']]);
        }
        // NotificationHelper::broadcastLectureNotification($data['week_program_id'], 'New Lecture', "$lecture->name at $lecture->date ");
        return redirect()->route('lectures');
    }

    public function destroy($id)
    {
        Lecture::find($id)->delete();
        return redirect()->route('lectures');
    }
}
