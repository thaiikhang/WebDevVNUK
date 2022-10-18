<?php

use App\Http\Controllers\ArrayController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SimpleFormController;
use App\Http\Controllers\WelcomeController; 
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

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::get('/welcome', [WelcomeController::class,'xinchao']);

Route::get('/huhu', function() {
    return view('huhu');
})->name('huhu');

Route::group(['prefix'=>'MyGroup'], function() {
    Route::get('user1', [GroupController::class ,'firstUser']);
    Route::get('user2', [GroupController::class ,'secondUser']);
    Route::get('user3', [GroupController::class ,'thirdUser']);
});

Route::get('testarray', [ArrayController::class, 'getIndex']);

Route::get('simpleform', [SimpleFormController::class, 'simpleform']);
Route::post('simpleform', [SimpleFormController::class, 'store']);

