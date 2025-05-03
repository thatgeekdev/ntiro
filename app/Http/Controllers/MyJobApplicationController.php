<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyJobApplicationController extends Controller
{

    public function index()
    {
        return view('my_job_applications.index', 
            ['applications' => auth()->user()->jobApplications()
                ->with([
                    'job' => fn($query) => $query->withCount('jobApplications') //counts of this job relactionship with the job applicatios that we have
                        ->withAvg('jobApplications', 'expected_salary'),
                        'job.employer'
                    ])
                ->latest()->get(),
        ]);
    }


    public function destroy(string $id)
    {
        //
    }
}
