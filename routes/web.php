<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;

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
})->name('welcome');


Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('/logout', [LogoutController::class ,'logout'])->name('logout');

Route::post('login',[LoginController::class, 'store'])->name('login.store');


Route::get('test',function (){
    return view('test');
})->name('test');
