<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ImageController::class, 'index']);
Route::post('/kirim', [ImageController::class, 'store']);
