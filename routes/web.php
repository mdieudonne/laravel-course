<?php

use App\Http\Controllers\AppController;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/logout-manual', function(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect(RouteServiceProvider::HOME);
});

Route::get('/{any}', [AppController::class, 'index'])->where('any', '.*');
