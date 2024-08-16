<?php

use App\Http\Controllers\BestBallController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', function () {
    //landing page:
    //dd('test');
    return Inertia::render('Landing');
});

Route::get('/leagues/{league}', [LeagueController::class, 'show'])->name('leagues.show');




//bestball is just a custom thing to sort my own bestball rankings for draftkings. 
Route::get('/bestball', [BestBallController::class, 'index'])->name('bestball.index');

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
