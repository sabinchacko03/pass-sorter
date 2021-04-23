<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassSorterController;

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

Route::get('/', [PassSorterController::class, 'home']);

// Route::get('/upload-file', [FileUpload::class, 'createForm']);

Route::post('/upload-file', [PassSorterController::class, 'uploadFile'])->name('fileUpload');

Route::post('/json-form', [PassSorterController::class, 'jsonForm'])->name('jsonForm');