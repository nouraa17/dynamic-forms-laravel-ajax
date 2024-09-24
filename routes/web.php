<?php

use App\Http\Controllers\AnswerControllerResource;
use App\Http\Controllers\CategoryControllerResource;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductControllerResource;
use App\Http\Controllers\QuestionControllerResource;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// login routes
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login-post',[LoginController::class,'login'])->name('auth.login');

// logout route
Route::get('/logout',[LogoutController::class,'logout_system'])->middleware('auth');

// resource routes

Route::resources([
    'categories' => CategoryControllerResource::class,
    'products' => ProductControllerResource::class,
]);

Route::get('/categories/{category}/questions', [ProductControllerResource::class, 'getQuestions'])->name('categories.questions');
