<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\TripController;

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

Route::get('index',function (){
    return view('Index.index');
})->name('index');


Route::middleware(['auth'])->group(function () {
    Route::get('/add/travel', [TripController::class, 'indexAddTravels'])->name('travels.index');
    Route::post('/addtravel', [TripController::class, 'travelCheck'])->name('travel.check');
    Route::get('/result/travels', [TripController::class, 'indexTravels'])->name('travelsAdd.index');
});
