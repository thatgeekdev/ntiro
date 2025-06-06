<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\MyJobApplicationController;

Route::get('', fn()=>to_route('jobs.index'));

Route::resource('jobs', JobController::class)->only(
    'index','show'
);

Route::get('login', fn()=>to_route('auth.create'))->name('login');

Route::resource('auth', AuthController::class)->only(
    'create','store'
);
Route::delete('logout', fn()=>to_route('auth.destroy'))->name('logout');
Route::delete('auth', [AuthController::class, 'destroy' ])->name('auth.destroy');

Route::middleware('auth')->group(function () {

    Route::resource('jobs.application', JobApplicationController::class)
    ->only('create','store','destroy'
    );

    Route::resource('my-job-applications', MyJobApplicationController::class)
    ->only('index','destroy');

    Route::resource('employer', EmployerController::class)
    ->only(['create','store']);

    Route::middleware('employer')->resource('my-jobs', MyJobController::class);
});