<?php

use App\Http\Controllers\GroupController;

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('groups',GroupController::class);
Route::resource('subjects',SubjectController::class);
Route::resource('users', UserController::class);
Route::resource('users.subjects', UserSubjectController::class);
