<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('index',[PageController::class, 'getIndex']);
Route::get('loai-san-pham',[PageController::class, 'getLoaiSp']);
Route::get('chi-tiet-san-pham',[PageController::class, 'getChitiet']);
Route::get('lien-he', [PageController::class, 'getLienhe']);
Route::get('gioi-thieu',[PageController::class, 'getAbout']);