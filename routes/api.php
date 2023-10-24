<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//api/v1
Route::group(['prefix' => 'v1', 'namespace'=> 'App\Http\Controllers\API\V1','middleware'=>'auth:sanctum'], function() {
    Route::apiResource('students', StudentController::class);
    Route::apiResource('courses', CoursesController::class);

    Route::post('courses/bulk', ['uses'=>'CoursesController@bulkStore']);
    Route::post('students/bulk', ['uses'=>'StudentController@bulkStore']);
});