<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobsController extends Controller
{
    public function index(){
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }
    
    public function show(Job $job)
    {
        return view('jobs.show', [
            'job' => $job,
        ]);
    }

    public function store()
    {
        //validation
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        // $job = new Job();
        // $job->title = request('title');
        // $job->salary = request('salary');
        // $job->employer_id = 1;
        // $job->save();

        Mail::to('eliascse33@gmail.com')->send(
            new \App\Mail\JobPosted($job)
        );

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        // authorize
        // Gate::authorize('edit-job', $job);

        // second option
        // if (Auth::user()->cannot('edit-job', $job)) {
        //     abort(403);
        // }

        return view('jobs.edit', [
            'job' => $job,
        ]);
    }

    public function update(Job $job)
    {
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
        // $job = Job::findOrFail($id);

        // $job->title = request('title');
        // $job->salary = request('salary');
        // $job->save();

        // another option
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        // redirect
        return redirect('jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        // authorize (on hold...)

        $job->delete();
        // redirect
        return redirect('/jobs');
    }
}
