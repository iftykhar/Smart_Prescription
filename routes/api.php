<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicineSuggestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Doctor;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('doctor', function (){
   return Doctor::all();
});

Route::resource('doctor', DoctorController::class);
Route::resource('MedicineSuggestion', MedicineSuggestionController::class);
