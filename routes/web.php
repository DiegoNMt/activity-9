<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() // Revisa si el usuario ya está autenticado/ loggeado
        ? redirect()->route('dashboard') // Si el usuario está autenticado, redirige al dashboard
        : redirect()->route('landingpage'); // Si el usuario no está autenticado, muestra la página de inicio (landing page)
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('/landingpage', 'landingpage')->name('landingpage'); // Name is for adding it in blade

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
