<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryCollegeController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/user', [App\Http\Controllers\UserController::class, 'store']);


Route::get('get_countries', [CountryCollegeController::class, 'getCountries']);
Route::post('get_colleges', [CountryCollegeController::class, 'getColleges']);

Route::get('get_names', [UserController::class, 'getNames']);
Route::post('get_users', [UserController::class, 'getUsers']);