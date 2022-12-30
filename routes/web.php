<?php

use App\Http\Controllers\Web\GradeBookController;
use App\Http\Controllers\Web\GroupController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\SubjectController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\UserSubjectController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('groups', GroupController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('users', UserController::class)->withTrashed();
    Route::resource('users.subjects', UserSubjectController::class);
    Route::get('/gradebook', [GradeBookController::class, 'index'])->name('gradebook.index');
    Route::get('users/{user}/export', [UserController::class, 'export'])
        ->name('users.export')->withTrashed();
    Route::get('users/{user}/forceDelete', [UserController::class, 'forceDelete'])
        ->name('users.force.delete');
    Route::get('users/{user}/restore', [UserController::class, 'restore'])
        ->name('users.restore')->withTrashed();
});

require __DIR__.'/auth.php';
