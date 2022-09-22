<?php


use App\Http\Controllers\ApiTestController;
use App\Http\Controllers\token\TokenController;
use App\Http\Controllers\token\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => '/v1'], function () {

    Route::post('/token', [TokenController::class, 'create']);
    Route::post('/user', [UserController::class, 'create']);
    Route::delete('/delete/{id}', [UserController::class, 'delete']);
    Route::get('/view/{id}', [UserController::class, 'view']);
    Route::get('/index', [UserController::class, 'index']);
    Route::put('/update/{id}', [UserController::class, 'update']);

});
Route::get('/test',[ApiTestController::class, 'Api']);

