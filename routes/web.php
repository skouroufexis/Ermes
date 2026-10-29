<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Upload;
use App\Http\Controllers\Pdfs;

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

Route::get('/', function () {
    return view('index');
});





Route::post('/', function () {
    return view('index');
});



Route::get('/1', function () {
    return view('test');
});




Route::get('/test', function () {
    return view('test',['name'=>'uei']);
});

Route::get('/test1', function () {
    return view('pdfPrinted',['name'=>'uei']);
});



Route::post('/checkType',[Upload::class, 'fileType']);

Route::post('/loadVariables',[Upload::class, 'loadVariables']);

Route::post('/checkType',[Upload::class, 'fileType']);

Route::post('/imageType',[Upload::class, 'imageType']);










