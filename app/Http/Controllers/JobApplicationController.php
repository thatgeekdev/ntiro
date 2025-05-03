<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{


    public function create(Job $job)
    {
        return view('job-application.create', [
            'job' =>$job,
        ]);
    }

 
    public function store(Job $job, Request $request)
    {
        $job -> jobApplications()->create([
            'user_id' => $request->user()->id,
            ...$request->validate([                     //return a arry with the other elements validated
                'expected_salary' => 'required|integer|min:1|max:1000000',
            ]),

        ]);
        return redirect()->route('jobs.show', $job)->with('success', 'Application submitted successfully!');
    }


    public function destroy(string $id)
    {
        //
    }
}
