<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Job::class); // Check if the user can view any job
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        );

        return view('jobs.index',
             ['jobs' => Job::with('employer')->latest()->filter($filters)->get()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $this->authorize('view', $job); // Check if the user can view the job
        return view('jobs.show',
         ['job'=> $job->load('employer.jobs')]); //employer.jobs load the employer and all the jobs on the relation
    }
}
