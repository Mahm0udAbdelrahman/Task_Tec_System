<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Route::apiResource('users',UserController::class);


//It is better because if there is permission, we can put it on every route


Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/',  'index');
    Route::post('/',  'store');
    Route::get('/{id}',  'show');
    Route::put('/{id}',  'update');
    Route::delete('/{id}',  'destroy');
});
