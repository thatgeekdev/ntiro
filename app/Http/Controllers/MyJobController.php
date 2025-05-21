<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class MyJobController extends Controller
{

    public function index()
    {
        return view('my_jobs.index', [
            'jobs' => request()->user()->employer
            ->jobs()
            ->with(['employer','jobApplications','jobApplications.user'])
            ->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('my_jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:4000',
            'experience' => 'required|in:'. implode(',', Job::$experience),
            'category' => 'required|in:'. implode(',', Job::$category),
        ]);

        request()->user()->employer->jobs()->create($validatedData); //Job create on the employer model

        return redirect()->route('my-jobs.index')->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
