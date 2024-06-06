<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('jobs/', function (){
    $jobs = Job::with('employer')->get();

    return view('jobs', [
        'jobs' => $jobs,
    ]);
});

Route::get('jobs/{id}', function ($id) {
    // $job = Arr::first($jobs, fn ($job) => $job['id'] == $id); another way to get the job
    $job = Job::find($id);

    return view('job', [
        'job' => $job,
    ]);
});

Route::get('contact/', function () {
    return view('contact');
});