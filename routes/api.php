<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Database\Events\TransactionCommitted;

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

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/',[TransactionController::class,'index']);
    Route::get('/{id}',[TransactionController::class,'findbyId']);
    Route::get('/{method}',[TransactionController::class,'findbyMethod']);
    Route::post('/store',[TransactionController::class,'store']);
    Route::post('/update/{id}',[TransactionController::class,'update']);
    Route::delete('/delete/{id}',[TransactionController::class,'destroy']);
});

