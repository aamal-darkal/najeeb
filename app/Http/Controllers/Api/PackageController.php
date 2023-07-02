<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Resources\PackagesResource;
use App\Models\Package;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getMySubjects()
    {
       
        $studentId = Student::select('id')->where('user_id', Auth::id())->first()->id;

        $packages = Package::whereHas('subjects', function($query) use ($studentId){
                 $query->whereHas('students', function($query) use ($studentId){
                     $query->where('student_id', $studentId);
                }) ;
            })
            ->with('subjects.lectures.pdfFiles')
            ->get();
        if ($packages) {
            $data = ['my_classes' => PackagesResource::collection($packages)];
            return ResponseHelper::success($data, 'Your packages');
        }
        return response()->json(
            [
                'message' => 'You did not apply to any package yet'
            ]
        );
    }

    public function getSubjects()
    {
        //return all packages with all detail  and relation to student            
        $packages = Package::with('subjects.lectures.pdfFiles')->get();
        $studentId = Student::select('id')->where('user_id', Auth::id())->first()->id;
        //get ids of student subjects
        $studentSubjectsIds = Subject::select('id')->whereHas('students', function($q) use($studentId) {
            $q->where('student_id', $studentId);
        })->pluck('id')->toArray();

        //Add has_relation field to every subject        
        $packages = $packages->map(function ($package) use ($studentSubjectsIds) {
            $package->subjects = $package->subjects->map(function ($subject) use ($studentSubjectsIds) {
                $subject->has_relation = in_array($subject->id, $studentSubjectsIds);
                return $subject;
            });

            return $package;
        });
        if ($packages) {
            $data = ['my_classes' => PackagesResource::collection($packages)];
            return ResponseHelper::success($data, 'Your packages');
        }
        return response()->json(
            [
                'message' => 'There is no packages yet'
            ]
        );
    }

    public function getPublicSubjects()
    {     
        $packages = Package::with('subjects.lectures.pdfFiles')->get();
        if ($packages) {
            $data = ['my_classes' => PackagesResource::collection($packages)];
            return ResponseHelper::success($data, 'Your packages');
        }
        return response()->json(
            [
                'message' => 'There is no packages yet'
            ]
        );
    }
}
