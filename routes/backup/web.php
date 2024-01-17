<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;

// route aktivasi akun
// Route::get('/', [EmailController::class, 'index']);
Route::get('/password/{id}', [EmailController::class, 'password'])->name('password');
Route::post('/aktivasi', [EmailController::class, 'aktivasi'])->name('aktivasi');

    // Pastikan bahwa request bukan untuk route aktivasi
    if (request()->path() !== 'password' && request()->path() !== 'aktivasi') {
        Route::get('/{any?}', function () {
            return view('admin');
        })->where('any', '.*');
    } else {
        abort(404); // Jika path adalah 'password' atau 'aktivasi', kembalikan 404 Not Found
    }

