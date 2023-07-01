<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShowLectureResource;
use App\Models\Lecture;
use App\Models\Package;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LectureController extends Controller
{
    public function timeTable()
    {
        $data['sunday'] = [] ;
        $data['monday'] = [] ;
        $data['tuesday'] = [] ;
        $data['wednesday'] = [] ;
        $data['thursday'] = [] ;
        $data['friday'] = [] ;
        $data['saturday'] = [] ;
        $student = Student::where('user_id', Auth::id())->with('subjects.weekProg')->first();
        $subjects  = json_decode($student->subjects,true);
        $subjectDetails = $student->subjects;
        $packagesNames = Package::select('id','name')->find($subjectDetails->pluck('package_id')->unique());
        foreach ($subjects as $subject) {
            $weekProg = $subject['week_prog'];
            $day = $weekProg['day'];
            $subjectId = $weekProg['subject_id'];
            //return $subjectDetails;
            switch ($day) {
                case 'sunday':
                    array_push($data['sunday'] , $subjectDetails->find($subjectId)->name .' / '. $packagesNames->find($subjectDetails->find($subjectId)->package_id)->name);
                    break;
                case 'monday':
                    array_push($data['monday'] , $subjectDetails->find($subjectId)->name  .' / '. $packagesNames->find($subjectDetails->find($subjectId)->package_id)->name);
                    break;
                case 'tuesday':
                    array_push($data['tuesday'] , $subjectDetails->find($subjectId)->name  .' / '. $packagesNames->find($subjectDetails->find($subjectId)->package_id)->name);
                    break;
                case 'wednesday':
                    array_push($data['wednesday'] , $subjectDetails->find($subjectId)->name  .' / '. $packagesNames->find($subjectDetails->find($subjectId)->package_id)->name);
                    break;
                case 'thursday':
                    array_push($data['thursday'] , $subjectDetails->find($subjectId)->name  .' / '. $packagesNames->find($subjectDetails->find($subjectId)->package_id)->name);
                    break;
                case 'friday':
                    array_push($data['friday'] , $subjectDetails->find($subjectId)->name  .' / '. $packagesNames->find($subjectDetails->find($subjectId)->package_id)->name);
                    break;
                case 'saturday':
                    array_push($data['saturday'] , $subjectDetails->find($subjectId)->name  .' / '. $packagesNames->find($subjectDetails->find($subjectId)->package_id)->name);
                    break;

            }
        }
        return $data;
    }

    public function show($id)
    {
        $lecture = Lecture::find($id);
        return new ShowLectureResource($lecture) ;
    }
}
