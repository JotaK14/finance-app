<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('splitScreen');
})->middleware('terminar.sessao');

Route::get('/login', [LoginController::class, 'show'])->middleware('terminar.sessao')->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/main', [MainController::class, 'show'])->middleware('auth')->name('main');
Route::patch('/main/valores', [MainController::class, 'atualizarValores'])->middleware('auth')->name('main.valores');
Route::post('/main/ganhos', [MainController::class, 'guardarGanho'])->middleware('auth')->name('main.ganhos');
Route::post('/main/despesas', [MainController::class, 'guardarDespesa'])->middleware('auth')->name('main.despesas');

Route::get('/register', [RegisterController::class, 'show'])->middleware('terminar.sessao')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
