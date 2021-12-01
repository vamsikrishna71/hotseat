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

Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'] )->name('employee')->middleware('employee');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('companyAdmin')->middleware('companyAdmin');

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

// Route::post('/edit', [App\Http\Controllers\HomeController::class, 'editLocation']);

Route::get('editlocation/{id}', [App\Http\Controllers\LocationController::class, 'editLocation'])->name('editlocation');

Route::post('/updatelocation/{id}', [App\Http\Controllers\HomeController::class, 'updateLocation'])
->name('updateLocation');

Route::get('/location', [App\Http\Controllers\LocationController::class,
'locationOverview'])->name('location');

Route::delete('/location/{id}', [App\Http\Controllers\LocationController::class,'destroy'])->name('destroy');



