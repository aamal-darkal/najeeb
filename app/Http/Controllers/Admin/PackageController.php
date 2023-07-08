<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageRequest;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::withCount('subjects')->get();
        return view('pages.packages.index', compact('packages'));
    }

    public function paginatedIndex(Request $request)
    {
        if ($request->ajax()) {
            $packages = Package::withCount('subjects')->paginate(2);
            return view('pages.packages.index', compact('packages'))->render();
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request): RedirectResponse
    {
        $package  = Package::create($request->validated());

        if ($request->file('image')) {
            $path = 'images/packages';
            $file = $request->file('image');
            $filename = $package->id . '.' . $file->extension();
            $file->storeAs($path,  $filename, 'public');
        } else
            $filename = 'no-image.png';
        $package->image = $filename;
        $package->save();

        return redirect()->route('packages');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $package = Package::with('subjects')->find($request->package_id);
        return view('pages.packages.show', compact('package'));
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
    public function destroy(string $id): RedirectResponse
    {
        Package::find($id)->delete();
        return redirect()->back();
    }
}
