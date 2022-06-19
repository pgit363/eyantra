<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryCollegeController;
use App\Http\Controllers\UserController;

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

Route::get('/registration', function () {
    return view('welcome');
});

Route::get('/users', function () {
    return view('users');
});

Route::get('get_countries', [CountryCollegeController::class, 'getCountries']);
Route::post('get_colleges', [CountryCollegeController::class, 'getColleges']);

Route::get('get_names', [UserController::class, 'getNames']);
Route::post('get_users', [UserController::class, 'getUsers']);
