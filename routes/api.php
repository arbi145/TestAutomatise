<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Projet1Controller;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\PythonController;
use App\Models\Projet;

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

Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
//Route::get('/run-python/{url}',[PythonController::class,'run']);
//Route::get('affiche',[ProjetController::class,'index']);
//Route::post('ajout',[ProjetController::class,'store']);
//Route::put('update',[ProjetController::class,'update']);
//Route::delete('delete',[ProjetController::class,'destroy']);

Route::apiResource('projets',ProjetController::class);
Route::post('/hello',[PythonController::class,'run']);
Route::get('/data', function(){
    $data = Projet::all();
    return response()->json($data);
});
Route::post('/get-scores',[PythonController::class,'getScores']);

