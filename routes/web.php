<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\KanbanBoard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/kanban', KanbanBoard::class)->name('kanban');
    
    Route::get('/candidates/{id}', function ($id) {
        return view('candidates.show', ['id' => $id]);
    })->name('candidates.show');
});
