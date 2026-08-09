<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Sp2dController;
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/sp2d', [Sp2dController::class, 'sp2d']);
Route::get('/instansi', [Sp2dController::class, 'instansi']);
