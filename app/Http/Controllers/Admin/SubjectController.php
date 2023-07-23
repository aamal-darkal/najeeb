<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Models\Package;
use App\Models\Subject;
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
        $subjects = Subject::with('package','weekProgs')->withCount('students')->get();
        return view('pages.subjects.index',compact('subjects'));
    }

    public function create()
    {
        $packages = Package::with('subjects')->withCount('subjects')->get();
        return view('pages.subjects.create-step1',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create2(Request $request)
    {
        $package = Package::with('subjects','subjects.weekProgs')->find($request->package_id);
        $notAllowedTimes = [];        
        return view('pages.subjects.create-step2',compact('package', 'notAllowedTimes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request): RedirectResponse
    {
        $subject = Subject::create($request->only(['name','cost','package_id']));
        $days = $request->days;
        foreach($days as $i => $day) {
            $start_time = Carbon::createFromFormat('h:i A', $request['start_times'][$i]);
            $end_time = Carbon::createFromFormat('h:i A', $request['end_times'][$i]);
            $subject->weekProgs()->create(['day' => $day ,'start_time' => $start_time,'end_time' => $end_time]);
        }             

        return redirect()->route('subjects.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)    
    {
        if ( $subject->lectures->count()) return back()->with('error', 'sorry, we can\'t delete subject that has lecture, you should delete its lectures ');
        if ( $subject->students->count()) return back()->with('error', 'sorry, we can\'t delete subject that subcribed by students, you should choose unsubcribe option before ');
        if ( $subject->orders->count()) return back()->with('error', 'sorry, we can\'t delete subject that ordered by students');
        /* no fix for order!!*/
        $subject->delete();
        return back()->with('success', 'package deleted successfuly');
    }
}
