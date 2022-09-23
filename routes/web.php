<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuratController;
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
Auth::routes();
Route::get('/', function () {
    return redirect('login');
});

//admin area
Route::get('/home', [HomeController::class, 'index']);

//admin surat
Route::get('/admin/surat', [SuratController::class, 'index']);
Route::get('/admin/surat/developer', [SuratController::class, 'about']);
Route::get('/admin/surat/download/{id}', [SuratController::class, 'download_pdf']);
Route::get('/admin/surat/create_page', [SuratController::class, 'createPage']);
Route::get('/admin/surat/edit/{id}', [SuratController::class, 'editPage']);
Route::get('/admin/surat/detail/{id}', [SuratController::class, 'detailPage']);
Route::post('/admin/surat/create', [SuratController::class, 'create']);
Route::post('/admin/surat/update/{id}', [SuratController::class, 'update']);
Route::get('/admin/surat/delete/{id}', [SuratController::class, 'delete']);

