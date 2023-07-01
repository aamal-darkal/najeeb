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
        $subjects = Subject::with('package','weekProg')->withCount('students')->get();
        return view('pages.subjects.index',compact('subjects'));
    }

    public function create1()
    {
        $packages = Package::with('subjects')->withCount('subjects')->get();
        return view('pages.subjects.create-step1',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create2(Request $request)
    {
        $package = Package::with('subjects','subjects.weekProg')->find($request->package_id);
        $notAllowedTimes = [];
        foreach ($package->subjects as $subject)
        {
            array_push($notAllowedTimes , [Carbon::parse($subject->weekProg->start_time)->format('g'), Carbon::parse($subject->weekProg->end_time)->format('g')]);
        }
        //return $notAllowedTimes;
        return view('pages.subjects.create-step2',compact('package', 'notAllowedTimes'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request): RedirectResponse
    {
        $request['start_time'] = Carbon::createFromFormat('g:i A', $request['start_time']);
        $request['end_time'] = Carbon::createFromFormat('g:i A', $request['end_time']);
        $subject = Subject::create($request->only(['name','cost','package_id']));
        $subject->weekProg()->create($request->only(['day','start_time','end_time']));

        return redirect()->route('subjects');
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
    public function destroy($id): RedirectResponse
    {
        $subject = Subject::find($id);
        $subject->delete();
        return redirect()->route('packages');
    }
}
