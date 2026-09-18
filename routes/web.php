<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('splitScreen');
})->middleware('terminar.sessao');

Route::get('/login', [LoginController::class, 'show'])->middleware('terminar.sessao')->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/main', [MainController::class, 'show'])->middleware('auth')->name('main');
Route::patch('/main/valores', [MainController::class, 'atualizarValores'])->middleware('auth')->name('main.valores');
Route::patch('/main/irs', [MainController::class, 'guardarIrs'])->middleware('auth')->name('main.irs');
Route::post('/main/ganhos', [MainController::class, 'guardarGanho'])->middleware('auth')->name('main.ganhos');
Route::post('/main/despesas', [MainController::class, 'guardarDespesa'])->middleware('auth')->name('main.despesas');
Route::patch('/main/movimentos/{movimento}', [MainController::class, 'atualizarMovimento'])->middleware('auth')->name('main.movimentos.atualizar');
Route::delete('/main/movimentos/{movimento}', [MainController::class, 'apagarMovimento'])->middleware('auth')->name('main.movimentos.apagar');

Route::get('/register', [RegisterController::class, 'show'])->middleware('terminar.sessao')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/esqueci-a-password', [PasswordController::class, 'mostrarPedido'])->middleware('terminar.sessao')->name('password.request');
Route::post('/esqueci-a-password', [PasswordController::class, 'enviarLink'])->middleware('terminar.sessao')->name('password.email');
Route::get('/redefinir-password/{token}', [PasswordController::class, 'mostrarFormulario'])->middleware('terminar.sessao')->name('password.reset');
Route::post('/redefinir-password', [PasswordController::class, 'guardarNovaPassword'])->middleware('terminar.sessao')->name('password.update');
