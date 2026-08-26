<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('splitScreen');
});

Route::get("/login", function () {
    return view('loginScreen');
})->name("login");

Route::get("/register", function () {
    return view('registerScreen');
})->name("register");

Route::get("/main", function () {
    return view('mainScreen');
})->name("main");
