<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\kontenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\siswaLoginController;

Route::get('/', [kontenController::class, 'landing'])->name('landing');
Route::get('/login',[adminController::class, 'formLogin'])->name('login');
Route::post('/login', [AdminController::class, 'prosesLogin'])->name('login.post');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/home', [SiswaController::class, 'home'])->name('home');

Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');

Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::post('/siswa/{id}/update', [SiswaController::class, 'update'])->name('siswa.update');

Route::get('/siswa/{id}/delete', [SiswaController::class, 'destroy'])->name('siswa.delete');

Route::get('/register', [AdminController::class, 'formregister'])->name('register');
Route::post('/register',[adminController::class, 'prosesRegister'])->name('register.post');

Route::get('/detil/{id}', [kontenController::class, 'detil'])->name('detil');

