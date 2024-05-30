<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('jobs/', function () {
    return view('jobs', [
        'jobs' => [
            [
                'id' => 1, // Add this line
                'title' => 'Programmer',
                'salary' => '$50,000',
            ],
            [
                'id' => 2, // Add this line
                'title' => 'Developer',
                'salary' => '$60,000',
            ],
            [
                'id' => 3, // Add this line
                'title' => 'Teacher',
                'salary' => '$70,000',
            ],
        ],
    ]);
});

Route::get('jobs/{id}', function ($id) {
    $jobs = [
        [
            'id' => 1,
            'title' => 'Programmer',
            'salary' => '$50,000',
        ],
        [
            'id' => 2,
            'title' => 'Developer',
            'salary' => '$60,000',
        ],
        [
            'id' => 3,
            'title' => 'Teacher',
            'salary' => '$70,000',
        ],
    ];

    // $job = Arr::first($jobs, fn ($job) => $job['id'] == $id); another way to get the job

    $job = collect($jobs)->firstWhere('id', $id);

    return view('job', [
        'job' => $job,
    ]);
});

Route::get('contact/', function () {
    return view('contact');
});