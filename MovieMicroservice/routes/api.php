<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
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

Route::controller(UserController::class)
    ->prefix('user')
    ->group(function () {
        Route::get('/', 'login');
        Route::post('/', 'register');

        Route::middleware('access_token')->group(function () {
            Route::patch('/', 'update');
            Route::get('/detail', 'getDetails');
        });
    });


Route::controller(MovieController::class)
    ->prefix('movie')
    ->group(function () {
        Route::get('/list', 'list');

        Route::middleware('access_token')->group(function () {
            Route::middleware('role.admin')->group(function () {
                Route::post('/', 'create');
            });
        });
    });
