<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendenceController extends Controller
{
    public function setAttendence($lecture_id)
    {
        $student = Student::where('user_id',Auth::id())->first();
        $lecture = $student->lectures()->wherePivot('lecture_id' , $lecture_id)->first();
        
        if ($lecture)
        {   
            $lecture->pivot->update(['views' => $lecture->pivot->views + 1])    ;
            $lecture->save();
        }
        else {
            $student->lectures()->attach($lecture_id,['date' => Carbon::now() , 'views' =>1]);
            $lecture = $student->lectures()->wherePivot('lecture_id' , $lecture_id)->first();
        }

        // return ResponseHelper::success(['views' => $lecture->views], 'lecture has been viewed');
        return ResponseHelper::success(['views' => $lecture->pivot->views], 'lecture has been viewed');
    }   

    public function getTodayAttendences()
    {
        $student = Student::where('user_id',Auth::id())->first();
        $todaylectureCount = $student->lectures()->wherePivot('date' , Carbon::now()->format('Y-m-d'))->count();
        $todayViewsSum = $student->lectures()->wherePivot('date' , Carbon::now()->format('Y-m-d'))->sum('views');
        
        return ResponseHelper::success(['lectureCount' => $todaylectureCount, 
                                        'sumOfViews' => $todayViewsSum],
                                 'count of lectures has been viewed today');
    }
}
