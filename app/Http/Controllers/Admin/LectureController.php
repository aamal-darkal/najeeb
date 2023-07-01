<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationHelper;
use App\Http\Requests\StoreLectureRequest;
use App\Http\Requests\StoreSubjectRequest;
use App\Models\Lecture;
use App\Models\Package;
use App\Models\Subject;
use App\Models\Week_program;
use App\Traits\ImageTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LectureController extends Controller
{
    use ImageTrait;
    public function index($subjectId = null)
    {

        $lecturess = Lecture::join('week_programs', 'week_programs.id', '=', 'lectures.week_program_id')
            ->when($subjectId, function ($query, $subjectId) {
                return $query->where('week_programs.subject_id', $subjectId);
            })
            ->select('lectures.id', 'name as title', DB::raw("CONCAT(date,'T',week_programs.start_time) as start") , DB::raw("CONCAT(date,'T',week_programs.end_time) as end"))
           // ->select('name as title', 'week_programs.start_time as start' ,'week_programs.end_time as end')
            ->get(3);
        $lecturess->map(function ($lectures){
            $lectures['color'] = ['#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT)] ;
            //$lectures['url'] = '{{route(\''.'test\''.','.$lectures->id.')}}';
            $lectures['url'] = route('lecture.show',$lectures->id);
            return $lectures;
        });
        foreach($lecturess as $key => $value) {
            $lectures[str_replace('""', '', $key)] = str_replace('""', '', $value);
        }
        if(isset($lectures))
        $lectures = implode(',',$lectures);
        else
            $lectures = null ;
        return view('pages.lectures.index',compact('lectures'));
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

        $packageName = $request->package_name;
        $subjects = Subject::where('package_id', $request->package_id)->with('weekProg')->get();
        return view('pages.lectures.create-step2',compact('subjects','packageName'));
    }

    public function create3(Request $request)
    {
        $packageName = $request->package_name;
        $subjectName = $request->subject_name;
        $weekProgId = $request->weekProg_id;
        $subjectId = $request->subject_id ;
        return view('pages.lectures.create-step3',compact('packageName', 'subjectName', 'subjectId', 'weekProgId'));
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
