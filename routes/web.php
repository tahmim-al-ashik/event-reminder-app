<?php

use App\Http\Controllers\CSVImportController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Redirect if already logged in
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout works only for authenticated users
Route::middleware('auth')->get('/logout', [AuthController::class, 'logout'])->name('logout');

// CSV Export (should be protected too)
Route::middleware('auth')->get('/events/export', [CSVImportController::class, 'export'])->name('events.export');

// Authenticated user routes
Route::middleware('auth')->group(function () {

    Route::get('/events/{event}/invite', [EventController::class, 'inviteForm'])->name('events.invite.form');
    Route::post('/events/{event}/invite', [EventController::class, 'sendInvite'])->name('events.invite.send');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/events/upcoming', [EventController::class, 'upcoming'])->name('events.upcoming');
    Route::get('/events/completed', [EventController::class, 'completed'])->name('events.completed');

    Route::get('/events/import', [CSVImportController::class, 'showForm'])->name('events.import.form');
    Route::post('/events/import', [CSVImportController::class, 'import'])->name('events.import');
});

// Welcome Page (Home)
Route::get('/', function () {
    return view('welcome');
})->name('home');
