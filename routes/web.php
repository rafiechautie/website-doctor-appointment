<?php


use App\Http\Controllers\Frontsite\AppointmentController;
use App\Http\Controllers\Frontsite\LandingController;
use App\Http\Controllers\Frontsite\PaymentController;
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

Route::resource('/', LandingController::class);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::resource('appointment', AppointmentController::class);

    Route::resource('payment', PaymentController::class);
});

//kalau udah login, maka bisa akses route yang ada di dalam group ini
//route didalam bisa diakses ketika auth:sanctumnya verified
Route::group(['prefix' => 'backsite', 'as' => 'backsite', 'middleware' => ['auth:sanctum', 'verified']],  function () {
    return view('dashboard');
});
