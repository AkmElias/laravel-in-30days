<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Models\Job;

Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::get('/test', function(){
    $job = Job::first();
    TranslateJob::dispatch($job);
});

// Route::resource('jobs', JobsController::class);
Route::get('/jobs', [JobsController::class, 'index']);
Route::get('/jobs/create', [JobsController::class, 'create']);
Route::post('/jobs', [JobsController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobsController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{job}/edit', [JobsController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job');
Route::patch('/jobs/{job}', [JobsController::class, 'update'])
    ->middleware('auth')
    ->can('edit', 'job');
Route::delete('/jobs/{job}', [JobsController::class, 'destroy'])
    ->middleware('auth')
    ->can('edit', 'job');


// Auth
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

// Destroy session
Route::post('/logout', [SessionController::class, 'destroy']);

