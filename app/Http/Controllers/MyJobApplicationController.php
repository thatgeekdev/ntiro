<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
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


    public function destroy(JobApplication $myJobApplication)
    {
        $myJobApplication->delete();
        
        return redirect()->back()->with(
            'success', 'Job application removed successfully'
        );
    }
}
