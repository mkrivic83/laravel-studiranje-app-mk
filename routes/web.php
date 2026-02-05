<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FakultetController;

Route::get('/', fn () => view('home'))->name('home');

// Fakulteti
Route::get('/fakulteti', [FakultetController::class, 'index'])
    ->name('fakulteti.index');

// Studenti – LIST + CREATE
Route::get('/studenti', [StudentController::class, 'index'])->name('studenti.index');
Route::get('/studenti/create', [StudentController::class, 'create'])->name('studenti.create');
Route::post('/studenti', [StudentController::class, 'store'])->name('studenti.store');

// Studenti – EDIT / UPDATE / DELETE (KLASIČNO)
Route::get('/studenti/{student}/edit', [StudentController::class, 'edit'])
    ->name('studenti.edit');

Route::put('/studenti/{student}', [StudentController::class, 'update'])
    ->name('studenti.update');

Route::delete('/studenti/{student}', [StudentController::class, 'destroy'])
    ->name('studenti.destroy');

// Studenti – SHOW (JEDINI S MIDDLEWAREOM)
Route::get('/studenti/{student}', [StudentController::class, 'show'])
    ->name('studenti.show')
    ->middleware('student.mjesto');

// Dummy linkovi
Route::get('/link1', fn () => redirect()->route('studenti.index'));
Route::get('/link2', fn () => redirect()->route('fakulteti.index'));
Route::get('/link3', fn () => view('about'))->name('about.index');