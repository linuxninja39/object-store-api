<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

Route::post('upload', 'FileController@upload')->name('upload');
Route::get('list', 'FileController@list')->name('list');
Route::get('file/{fileName}', 'FileController@getFile')->where(['fileName' => '[a-zA-z0-9 -_.]+']);

