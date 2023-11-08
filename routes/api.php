<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAppController;


Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'Login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/all-post', [AuthController::class, 'AllPost']);
    Route::post('/post', [AuthController::class, "PostProfile"]);
});


Route::get('/all-user', [UserAppController::class, 'AllUser']);
Route::post('/add-user', [UserAppController::class, 'AddUser']);
Route::put('/update-user', [UserAppController::class, 'UpdateUser']);
Route::delete('/delete-user', [UserAppController::class, 'DeleteUser']);