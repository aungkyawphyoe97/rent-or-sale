<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\BuildingController;
use  App\Http\Controllers\LocationController;
use  App\Http\Controllers\MeasurementController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('web')->group(function(){
    Route::controller(BuildingController::class)->group(function () {
        Route::get('/building','index');

        Route::get('/building/index','index');

        Route::get('/building/create','create');

        Route::post('/building/store','store');

        Route::get('/building/state/{countryId}','stateAjax');

        Route::get('/building/city/{stateId}','cityAjax');
    
    });
    Route::controller(LocationController::class)->group(function () {
        Route::get('/country/index','index');

        Route::post('/country/store','store');

        Route::get('/state/index/{country_id}','stateList');

        Route::post('/state/store','stateStore');

        Route::get('/city/index/{state_id}/{country_id}','cityList');

        Route::post('/city/store','cityStore');
    });

    Route::controller(MeasurementController::class)->group(function(){
        Route::get('/measurement/index','index');

        Route::post('/measurement/store','store');
    });


});
