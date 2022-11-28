<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\Api\Admin\KamarController;
use App\Http\Controllers\Api\Admin\KamarController as UserKamarController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Api\User\BookingKamar;



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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::prefix('admin')->group(function() {
        Route::resource('kamars', KamarController::class);
    });

    Route::post('booking', [BookingKamar::class, 'store']);
    Route::get('booking', [BookingKamar::class, 'show']);
    Route::resource('booking', BookingKamar::class);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('kamars', [UserKamarController::class, 'index']);
Route::get('kamars/{id}', [UserKamarController::class, 'show']);

Route::resource('hotels', HotelController::class)->except([
    'create', 'edit'
]);