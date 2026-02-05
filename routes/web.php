<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FakultetController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Fakulteti (samo prikaz svih)
Route::get('/fakulteti', [FakultetController::class, 'index'])->name('fakulteti.index');

// Student CRUD
// Middleware blokira show/edit/update/destroy za studente s mjesto = null
Route::resource('studenti', StudentController::class)->except(['show']);
Route::get('studenti/{student}', [StudentController::class, 'show'])
    ->name('studenti.show')
    ->middleware('student.mjesto');

// Dodaj middleware i na edit/update/destroy:
Route::middleware('student.mjesto')->group(function () {
    Route::get('studenti/{student}/edit', [StudentController::class, 'edit'])->name('studenti.edit');
    Route::put('studenti/{student}', [StudentController::class, 'update'])->name('studenti.update');
    Route::delete('studenti/{student}', [StudentController::class, 'destroy'])->name('studenti.destroy');
});

// Link1/Link2/Link3 iz layouta da ne pucaju:
Route::get('/link1', fn() => redirect()->route('studenti.index'));
Route::get('/link2', fn() => redirect()->route('fakulteti.index'));
Route::get('/link3', fn() => view('about'))->name('about.index');
