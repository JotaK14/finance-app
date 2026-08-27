<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('splitScreen');
})->middleware('terminar.sessao');

Route::get('/login', [LoginController::class, 'show'])->middleware('terminar.sessao')->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get("/main", function () {
    return view('mainScreen');
})->middleware('auth')->name("main");

Route::get('/register', [RegisterController::class, 'show'])->middleware('terminar.sessao')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
