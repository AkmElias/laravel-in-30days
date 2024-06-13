<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobsController;

Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::resource('jobs', JobsController::class);
