<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class MyJobController extends Controller
{

    public function index()
    {
        $this->authorize('viewAnyEmployes', Job::class); // Check if the user (employes) can view any job
        return view('my_jobs.index', [
            'jobs' => request()->user()->employer
            ->jobs()
            ->with(['employer','jobApplications','jobApplications.user'])
            ->withTrashed() // Show all jobs including the trashed ones
            ->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Job::class);
        return view('my_jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $this->authorize('create', Job::class);
        request()->user()->employer->jobs()->create($request->validated()); //Job create on the employer model

        return redirect()->route('my-jobs.index')
                ->with('success', 'Job created successfully.');
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
    public function edit(Job $myJob)
    {
        $this->authorize('edit', Job::class);
        return view('my_jobs.edit', [
            'job' => $myJob,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $myJob)
    {
        
        $this->authorize('update', $myJob);
        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        $myJob ->delete();
        return redirect()->route('my-jobs.index')
            ->with('success', 'Job deleted successfully.');
    }
}
