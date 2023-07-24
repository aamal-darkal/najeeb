<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Models\Attendee;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendeeController extends Controller
{
    public function attend($lecture_id)
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

        return ResponseHelper::success($lecture, 'lecture has been viewed');
    }
}
