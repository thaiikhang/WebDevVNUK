<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

//--------------------------Web sale--------------------------
Route::get('/trangchu', [PageController::class, 'getIndex']);

Route::get('/type/{id}', [PageController::class, 'getLoaiSp']);

Route::get('/detail/{id}', [PageController::class, 'getDetail']);

Route::get('/contact', [PageController::class, 'getContact']);

Route::get('/about', [PageController::class, 'getAbout']);

//-------------------------Cart---------------------------------
Route::get('add-to-cart/{id}', [PageController::class, 'getAddToCart'])->name('themgiohang');

Route::get('del-cart/{id}', [PageController::class, 'getDelItemCart'])->name('xoagiohang');

//-------------------------Checkout---------------------------------
Route::get('check-out', [PageController::class, 'getCheckout'])->name('dathang');
Route::post('check-out', [PageController::class, 'postCheckout'])->name('dathang');

//-------------------------Login/Register---------------------------------
Route::get('/register', function () {
    return view('page.register');
});
Route::post('/register', [PageController::class, 'Register']);

Route::get('/login', function () {
    return view('page.login');
});
Route::post('/login', [PageController::class, 'Login']);
Route::get('/logout', [PageController::class, 'Logout']);

//-------------------------ADMIN---------------------------------
Route::get('/admin', [PageController::class, 'getIndexAdmin']);

Route::get('/admin-add-form', [PageController::class, 'getAdminAdd'])->name('add-product');
Route::post('/admin-add-form', [PageController::class, 'postAdminAdd']);

Route::get('/admin-edit-form/{id}', [PageController::class, 'getAdminEdit']);
Route::post('/admin-edit', [PageController::class, 'postAdminEdit']);

Route::post('/admin-delete/{id}', [PageController::class, 'postAdminDelete']);

Route::get('/admin-export', [PageController::class, 'exportAdminProduct'])->name('export');

Route::get('/return-vnpay', function () {
    return view('vnpay.return-vnpay');
});





Route::get('loai-san-pham/{type}', [PageController::class, 'getLoaiSp']);

Route::get('chi-tiet-san-pham', [PageController::class, 'getLienhe']);

// Route::get('/product_model', [PageController::class, 'getModel']);
// Route::get('/product_detail', [PageController::class, 'getDetail']);

// Route::get('gioi_thieu', [
//     'as' => 'about',
//     'uses' =>'PageController@getAbout'
// ]);