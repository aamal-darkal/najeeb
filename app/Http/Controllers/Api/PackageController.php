<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Resources\PackagesResource;
use App\Models\Package;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isTrue;

class PackageController extends Controller
{
//    public function getMyPackages()
//    {
//        $studentId = Auth::id();
//        $packages = Package::whereHas('students', function ($query) use ($studentId) {
//            $query->where('student_id', $studentId);
//        })->get();
//        if ($packages)
//        return response()->json(
//            [
//                'data' => $packages,
//                'success' => true
//            ]
//        );
//        return response()->json(
//            [
//                'message' => 'You did not apply to any package yet'
//            ]
//        );
//    }

    public function getMySubjects()
    {
//        $packages = DB::table('packages')
//            ->join('subjects', 'packages.id', '=', 'subjects.package_id')
//            ->join('week_programs', 'subjects.id', '=', 'week_programs.subject_id')
//            ->join('lectures', 'week_programs.id', '=', 'lectures.week_program_id')
//            ->join('student_package', 'packages.id', '=', 'student_package.package_id')
//            ->where('student_package.student_id', '=', Auth::user()->student->id)
//            ->select('packages.id as package_id', 'subjects.id as subject_id', 'week_programs.id as week_program_id', 'lectures.id as lecture_id', 'packages.name as package_name', 'subjects.name as subject_name', 'lectures.name as lecture_name', 'packages.*', 'subjects.*', 'week_programs.*', 'lectures.*')
//            ->get();
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

//        $packages = DB::table('packages')
//            ->join('subjects', 'packages.id', '=', 'subjects.package_id')
//            ->join('week_programs', 'subjects.id', '=', 'week_programs.subject_id')
//            ->join('lectures', 'week_programs.id', '=', 'lectures.week_program_id')
//            ->leftJoin('student_package', 'packages.id', '=', 'student_package.package_id')
//            ->select('packages.id as package_id', 'subjects.id as subject_id', 'week_programs.id as week_program_id', 'lectures.id as lecture_id', 'packages.name as package_name', 'subjects.name as subject_name', 'lectures.name as lecture_name', 'packages.*', 'subjects.*', 'week_programs.*', 'lectures.*', DB::raw('IF(student_package.package_id IS NOT NULL, TRUE, FALSE) as has_relation'))
//            ->get();
        $packages = Package::with('subjects.lectures.pdfFiles')->get();
        $studentId = Student::select('id')->where('user_id', Auth::id())->first()->id;
        $studentSubjectsIds = Subject::select('id')->whereHas('students', function($q) use($studentId) {
            $q->where('student_id', $studentId);
        })->pluck('id')->toArray();

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

//        $packages = DB::table('packages')
//            ->join('subjects', 'packages.id', '=', 'subjects.package_id')
//            ->join('week_programs', 'subjects.id', '=', 'week_programs.subject_id')
//            ->join('lectures', 'week_programs.id', '=', 'lectures.week_program_id')
//            ->leftJoin('student_package', 'packages.id', '=', 'student_package.package_id')
//            ->select('packages.id as package_id', 'subjects.id as subject_id', 'week_programs.id as week_program_id', 'lectures.id as lecture_id', 'packages.name as package_name', 'subjects.name as subject_name', 'lectures.name as lecture_name', 'packages.*', 'subjects.*', 'week_programs.*', 'lectures.*', DB::raw('IF(student_package.package_id IS NOT NULL, TRUE, FALSE) as has_relation'))
//            ->get();
        $packages = Package::with('subjects.lectures.pdfFiles')->get();
//        $studentId = Student::select('id')->where('user_id', Auth::id())->first()->id;
//        $studentSubjectsIds = Subject::select('id')->whereHas('students', function($q) use($studentId) {
//            $q->where('student_id', $studentId);
//        })->pluck('id')->toArray();
//
//        $packages = $packages->map(function ($package) use ($studentSubjectsIds) {
//            $package->subjects = $package->subjects->map(function ($subject) use ($studentSubjectsIds) {
//                $subject->has_relation = in_array($subject->id, $studentSubjectsIds);
//                return $subject;
//            });
//
//            return $package;
//        });
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
