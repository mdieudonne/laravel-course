<?php

use App\Http\Controllers\BirthdaysController;
use App\Http\Controllers\ContactsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(
    function () {
        Route::get('/contacts', [ContactsController::class, 'index']);
        Route::post('/contacts', [ContactsController::class, 'store']);
        Route::get('/contacts/{contact}', [ContactsController::class, 'show']);
        Route::put('/contacts/{contact}', [ContactsController::class, 'update']);
        Route::delete('/contacts/{contact}', [ContactsController::class, 'destroy']);

        Route::get('/birthdays', [BirthdaysController::class, 'index']);
    }
);
