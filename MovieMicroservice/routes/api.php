<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
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
        Route::post('/pre-registration/', 'preRegister');

        Route::middleware('access_token')->group(function () {
            Route::patch('/', 'update');
            Route::get('/refresh/', 'refresh');
        });
    });


Route::controller(MovieController::class)
    ->prefix('movie')
    ->group(function () {

        Route::get('/list', 'list');
        Route::get('/{id}', 'get');

        Route::middleware('access_token')->group(function () {
            Route::middleware('role.viewer')->group(function () {
                Route::patch('/collections/{movieId}', 'updateCollections');
            });

            Route::middleware('role.admin')->group(function () {
                Route::post('/', 'create');
                Route::patch('/collections/default/{movieId}', 'updateDefaultCollections');
                Route::patch('/categories/{movieId}', 'updateCategories');

                Route::group(['prefix' => '{movieId}'], function () {
                    Route::delete('/', 'delete');
                });
            });
        });
    });

Route::controller(CategoryController::class)
    ->prefix('category')
    ->group(function () {
        Route::get('/list', 'list');

        Route::middleware('access_token')->group(function () {
            Route::middleware('role.admin')->group(function () {
                Route::post('/', 'create');
                Route::delete('/{categoryId}', 'delete');
            });
        });
    });

Route::controller(CollectionController::class)
    ->prefix('collection')
    ->group(function () {
        Route::get('/list', 'list');
        Route::get('/list/defaults/', 'listOfDefaults');

        Route::middleware('access_token')->group(function () {
            Route::post('/', 'create');

            Route::group(['prefix' => '{collectionId}'], function () {
                Route::delete('/', 'delete');
            });
        });
    });
