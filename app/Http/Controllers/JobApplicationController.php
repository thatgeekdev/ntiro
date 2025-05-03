<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobApplicationController extends Controller
{
    use AuthorizesRequests;


    public function create(Job $job)
    {
        $this->authorize('apply', $job); // Check if the user is authorized to create a job application
        return view('job-application.create', [
            'job' =>$job,
        ]);
    }

 
    public function store(Job $job, Request $request)
    {
        $this->authorize('apply', $job); // Check if the user is authorized to apply in a job application

        $job -> jobApplications()->create([
            'user_id' => $request->user()->id,
            ...$request->validate([                     //... to return a array with the other elements validated
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
