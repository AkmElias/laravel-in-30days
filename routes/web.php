<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('jobs/', function (){
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs,
    ]);
});

Route::get('jobs/create', function () {
    return view('jobs.create');
});

Route::get('jobs/{id}', function ($id) {
    // $job = Arr::first($jobs, fn ($job) => $job['id'] == $id); another way to get the job
    $job = Job::find($id);

    return view('jobs.show', [
        'job' => $job,
    ]);
});

Route::post('jobs/', function () {
    request()->all();

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    // $job = new Job();
    // $job->title = request('title');
    // $job->salary = request('salary');
    // $job->employer_id = 1;
    // $job->save();

    return redirect('jobs/');
});

Route::get('contact/', function () {
    return view('contact');
});