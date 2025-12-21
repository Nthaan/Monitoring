<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});


use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/logout-success');
})->name('logout');

Route::get('/logout-success', function () {
    return view('auth.logout-success');
});


