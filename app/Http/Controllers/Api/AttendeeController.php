<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Models\Attendee;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendeeController extends Controller
{
    public function attend($id)
    {
        $studentLectures = Student::where('user_id',Auth::id())->whereHas('lecturesAttended', function ($q) use ($id)
        {
            return $q->where('lecture_id', $id);
        })->with('lecturesAttended')->first();
        if ($studentLectures)
        {
            $lectures = $studentLectures->lecturesAttended->first() ;
            $lectures->pivot->update(['views' => $lectures->pivot->views + 1]);
            $lectures->save();
        }
        else
            $lectures = Student::where('user_id',Auth::id())->first()->lecturesAttended()->attach($id,['date' => Carbon::now() , 'views' =>1]);

        return ResponseHelper::success($lectures, 'lecture has been viewed');

    }
}
