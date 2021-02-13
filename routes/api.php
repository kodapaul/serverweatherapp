<?php

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/currentweather', [MainController::class, 'CurrentWeather']);
Route::get('/forecast7days', [MainController::class, 'Forecast7Days']);
Route::get('/sample', [MainController::class, 'sample']);
Route::get('/listofcities', [MainController::class, 'ListofCities']);
Route::get('/japanforecast', [MainController::class, 'JapanForecast']);
Route::get('/subweather', [MainController::class, 'SubWeather']);
