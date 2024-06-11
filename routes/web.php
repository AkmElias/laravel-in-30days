<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// index
Route::get('jobs/', function (){
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs,
    ]);
});

// create 
Route::get('jobs/create', function () {
    return view('jobs.create');
});

// show
Route::get('jobs/{id}', function ($id) {
    // $job = Arr::first($jobs, fn ($job) => $job['id'] == $id); another way to get the job
    $job = Job::find($id);

    return view('jobs.show', [
        'job' => $job,
    ]);
});

// store
Route::post('jobs/', function () {
    //validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

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

// edit
Route::get('jobs/{id}/edit', function ($id) {
    // $job = Arr::first($jobs, fn ($job) => $job['id'] == $id); another way to get the job
    $job = Job::find($id);

    return view('jobs.edit', [
        'job' => $job,
    ]);
});

// update
Route::patch('jobs/{id}', function ($id) {
    //validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    // authorize
    // $job = Job::find($id);
    // if ($job->employer_id !== 1) {
    //     abort(403);
    // }

    // update the job
    $job = Job::findOrFail($id);

    // $job->title = request('title');
    // $job->salary = request('salary');
    // $job->save();

    // another option
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
       ]);

    // redirect
    return redirect('jobs/' . $id);
});

// destroy
Route::delete('jobs/{id}', function ($id) {
    // authorize (on hold...)
    Job::findOrFail($id)->delete();
    // redirect
    return redirect('jobs/');
});

Route::get('contact/', function () {
    return view('contact');
});