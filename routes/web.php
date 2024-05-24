<?php

use App\Http\Controllers\AssetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::middleware('auth:web')->group(function () {

    Route::get('dashboard', [AuthController::class, 'dashboard']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(AssetController::class)->group(function () {
        Route::get('/assets', 'index')->name('assets.index');
        Route::get('/assets-add', 'create')->name('assets-add');
        Route::post('/assets-addAction', 'store')->name('assets-addAction');
        Route::get("/assets-edit/{id}", "edit");
        Route::post("/assets-edit-action", "update");
        Route::post("/assets-delete", "delete");
        Route::post('/assets-changeStatus', 'changeStatus')->name('assets-changeStatus');
    });
});
