<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Package;
use App\Models\Subject;
use App\Models\WeekProgram;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('package', 'weekProgs')->withCount('students')->get();
        return view('pages.subjects.index', compact('subjects'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'package' => 'required|exists:packages,id'
        ]);
        $package = Package::find($request->package);

        // return view('pages.subjects.create-step1',compact('packages'));
        // notAllowedTimes**************!!!!
        return view('pages.subjects.create', compact('package'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request): RedirectResponse
    {
        $subject = Subject::create($request->only(['name', 'cost', 'package_id']));
        $days = $request->days;
        foreach ($days as $i => $day) {
            $start_time = Carbon::createFromFormat('h:i A', $request['start_times'][$i]);
            $end_time = Carbon::createFromFormat('h:i A', $request['end_times'][$i]);
            $subject->weekProgs()->create(['day' => $day, 'start_time' => $start_time, 'end_time' => $end_time]);
        }

        return redirect()->route('package.show', ['packages' => $subject->package_id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('pages.subjects.edit', compact('subject'));
    }


    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->only(['name', 'cost', 'package_id']));
        
        $ids = $request->weekProgsIds;
        $states = $request->weekProgsStates;
        $days = $request->days;
        $start_times = $request->start_times;
        $end_times = $request->end_times;

        foreach ($days as $i => $day) {
            $start_time = Carbon::createFromFormat('h:i A', $start_times[$i]);
            $end_time = Carbon::createFromFormat('h:i A', $end_times[$i]);

            if ($states[$i] == 'new') {
                WeekProgram::create(['day' => $day, 'start_time' => $start_time, 'end_time' => $end_time]);
            } elseif ($states[$i] == 'del' && $ids[$i] != 'new') {
                WeekProgram::find($ids[$i])->delete();
            } elseif ($states[$i] == 'old') {
                $weekProgram = WeekProgram::find($ids[$i]);
                $weekProgram->update(['day' => $day, 'start_time' => $start_time, 'end_time' => $end_time]);
            }
        }

        return redirect()->route('package.show', ['packages' => $subject->package_id]);
    }

    /**
     *
     */
    public function show(Subject $subject)
    {
        $lectures = $subject->lectures()->orderby('date', 'desc')->get();
        return view('pages.subjects.show', compact('subject', 'lectures'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        if ($subject->lectures->count()) return back()->with('error', 'sorry, we can\'t delete subject that has lecture, you should delete its lectures first ');
        if ($subject->students->count()) return back()->with('error', 'sorry, we can\'t delete subject that subcribed by students first, you should unsubcribe students first ');
        $subject->delete();
        return back()->with('success', 'package deleted successfuly');
    }
}
