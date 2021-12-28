<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

//Grouping routes
Route::prefix('employee')->name('employee.')->group(function () {
    Route::middleware(['guest:employee'])->group(function () {
        Route::view('/login', 'employee.login')->name('login');
        Route::post('/check', [EmployeeController::class, 'employeeLogin'])->name('check');
    });
    Route::middleware(['auth:employee'])->group(function () {
        Route::view('/show', 'employee.show')->name('show');
    });
});

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

//Admin-Employee Controllers
Route::post('/addEmployee', [App\Http\Controllers\EmployeeController::class, 'addEmployee'])->name('addEmployee');

Route::get('/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'editEmployee'])->name('employee.edit');

Route::post('/update/{id}', [App\Http\Controllers\EmployeeController::class, 'updateEmployee'])
    ->name('employee.update');

Route::delete(
    '/employee/{id}',
    [App\Http\Controllers\EmployeeController::class, 'destroy']
)->name('employee.destroy');

//Desk controller
Route::post('/desk', [App\Http\Controllers\DeskController::class, 'createFloor'])->name('createFloor');

Route::get('/edit/{id}', [App\Http\Controllers\DeskController::class, 'editFloor'])->name('floor.edit');

// Route::get('/show/{id}', [App\Http\Controllers\DeskController::class,'show'])
// ->name('showMap');
