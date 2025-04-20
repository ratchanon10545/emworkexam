<?php

use App\Http\Controllers\UserDataController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserDataController::class, 'index'])->name('home');
Route::post('/users', [UserDataController::class, 'store'])->name('user.store');
Route::get('/users/{user}', [UserDataController::class, 'edit'])->name('user.edit');
Route::put('/users/{user}', [UserDataController::class, 'update'])->name('user.update');
Route::delete('/users/{user}', [UserDataController::class, 'delete'])->name('user.delete');
Route::get('/users-agechart', [UserDataController::class, 'showAgeChart'])->name('users.age_chart');
Route::get('/users-agereport', [UserDataController::class, 'ageReport'])->name('users.age_report');

Route::get('/temples', function () {
    return view('temples.temples2');
});