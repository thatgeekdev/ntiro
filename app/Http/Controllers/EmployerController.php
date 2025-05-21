<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Employer::class, 'employer');
    }

    public function create()
    {
        return view('employer.create');
    }

    public function store(Request $request)
    {
        auth()->user()
            ->employer()
            ->create($request->validate([
                'company_name' => 'required|string|min:3|max:255|:unique:employers,company_name',
            ]));
        return redirect()->route('jobs.index')
            ->with('success', 'Your Employes account was created successfully!');
    }
}
