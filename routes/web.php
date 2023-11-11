<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;

use App\Http\Controllers\VoucherController;

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

    return view('admin.auth.login');

})->name('login');

Route::get('home', function () {
    return view('welcome');



});

Route::post('login',[LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [LogoutController::class ,'logout'])->name('logout');



Route::get('/get/origins', [TripController::class, 'getOrigins']);
Route::get('/get/destinations/{origin}', [TripController::class, 'searchDestinations']);
Route::get('/seating/{origin}/{destination}/{date}', [TripController::class, 'seatings']);
Route::post('/check',[TripController::class, 'checkTravel']);



// ERROR: GET method not supported for this route. Supported methods: POST.


Route::get('reserva', [TripController::class, 'reserveIndex'])->name('reserve');
Route::post('reserva', [TicketController::class, 'store'])->name('ticket.store');


// PREGUNTAR CLIENTE: ¿solo los invitados (usuarios) pueden acceder al reservar?





Route::middleware(['auth'])->group(function () {
    Route::get('/cargarviajes', [UserController::class, 'dashboardIndex'])->name('index');
    Route::get('/add/travel', [TripController::class, 'indexAddTravels'])->name('travels.index');
    Route::post('/addtravel', [TripController::class, 'travelCheck'])->name('travel.check');
    Route::get('/result/travels', [TripController::class, 'indexTravels'])->name('travelsAdd.index');
});


Route::get('/travel-reservation/{id}', [VoucherController::class, 'generatePDF'])->name('generate.pdf');
Route::get('download-pdf/{id}', [VoucherController::class, 'downloadPDF'])->name('pdf.download');
