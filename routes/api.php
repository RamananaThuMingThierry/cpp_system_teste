<?php

use App\Http\Controllers\API\EtudiantController;
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

Route::get('/etudiant', [EtudiantController::class, 'index']);
Route::post('/etudiant_add', [EtudiantController::class, 'store']);
Route::get('/etudiant/{id}', [EtudiantController::class, 'show']);
Route::put('/etudiant_update/{id}', [EtudiantController::class, 'update']);
