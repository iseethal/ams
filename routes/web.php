<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/',[UserController::class,'LoginView'])->name('user.login-view');
Route::post('/login',[UserController::class,'CheckLogin'])->name('user.check-login');
Route::get('/register',[UserController::class,'Register'])->name('user.register');
Route::post('/save-register',[UserController::class,'SaveRegister'])->name('register.save');


Route::middleware(['admin'])->group(function () {

    Route::get('/dashboard',[UserController::class,'Dashboard'])->name('user.dashboard');
    Route::post('/logout',[UserController::class,'Logout'])->name('user.logout');
    Route::get('/users',[UserController::class,'Users'])->name('user.list');


    Route::get('/attendance-data',[AttendanceController::class,'AttendanceData'])->name('attendance.data');
    Route::get('/attendance-report',[AttendanceController::class,'AttendanceReport'])->name('attendance.report');
});
