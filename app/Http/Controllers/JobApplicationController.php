<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Contracts\Support\ValidatedData;
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
        
        $ValidatedData = $request->validate([
            'expected_salary' => 'required|integer|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048', // Validate the CV file
        ]);

        $file = $request->file('cv');
        $path = $file->store('cvs', 'private');

        $job -> jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $ValidatedData['expected_salary'],
            'cv_path' => $path,
        ]);
        return redirect()->route('jobs.show', $job)->with('success', 'Application submitted successfully!');
    }


    public function destroy(string $id)
    {
        //
    }
}
