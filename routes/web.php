<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DecoderController;
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

// Route::get('/', 'DecoderController@index' )->name('decode.view');
Route::get('/', [\App\Http\Controllers\DecoderController::class, 'index']) ->name('decode.view');
Route::post('/add', [\App\Http\Controllers\DecoderController::class, 'store']) ->name('decode.add');
