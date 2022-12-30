<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserSubjectController;
use App\Http\Controllers\Api\SubjectController;
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
Route::post('login',[AuthController::class, 'login']);
Route::post('resetPassword',[AuthController::class, 'resetPassword']);
Route::middleware('auth:api')->group(function() {
  Route::post('logout',[AuthController::class, 'logout']);
  Route::apiResource('users', UserController::class)->withTrashed();
  Route::get('users/{user}/export', [UserController::class, 'export'])->withTrashed();
  Route::delete('users/{user}/force_delete', [UserController::class, 'forceDelete'])->withTrashed();
  Route::post('users/{user}/restore', [UserController::class, 'restore'])->withTrashed();
  Route::apiResource('groups', GroupController::class);
  Route::apiResource('subjects', SubjectController::class);
  Route::apiResource('users.subjects', UserSubjectController::class);
});




