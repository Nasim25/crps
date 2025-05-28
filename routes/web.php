<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'Welcome Admin';
    });
});

Route::middleware(['permission:edit_post'])->group(function () {
    Route::get('/posts/edit', function () {
        return 'Edit Post';
    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
