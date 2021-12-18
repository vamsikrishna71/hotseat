<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])
    ->name('root');

Route::get('/login/employee', [App\Http\Controllers\Auth\LoginController::class,'showEmployeeLoginForm']);
Route::post('/login/employee', [App\Http\Controllers\Auth\LoginController::class, 'employeeLogin']);

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])
    ->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])
    ->name('updatePassword');
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

//Location Controllers
Route::post('/addlocation', [App\Http\Controllers\LocationController::class, 'location'])->name('addlocation');


Route::get('/editlocation/{location_id}', [App\Http\Controllers\LocationController::class, 'editLocation'])->name('location.edit');

Route::post('/update-location/{location_id}', [App\Http\Controllers\LocationController::class, 'updateLocation'])
    ->name('location.update');

Route::delete(
    '/location/{location_id}',
    [App\Http\Controllers\LocationController::class, 'destroy']
)->name('location.destroy');

//Employee Controllers
Route::post('/addEmployee', [App\Http\Controllers\EmployeeController::class, 'addEmployee'])->name('addEmployee');
