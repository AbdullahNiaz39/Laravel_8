<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\ProductReviewController;

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

////////////////////////   FRont END ///////////////////////////////
Route::get('/', [FrontController::class, 'index']);
Route::get('category/{id}', [FrontController::class, 'category']);
Route::get('product/{id}', [FrontController::class, 'product']);
Route::post('add_to_cart', [FrontController::class, 'add_to_cart']);
Route::get('cart', [FrontController::class, 'cart']);
Route::get('search/{str}', [FrontController::class, 'search']);
Route::get('registration', [FrontController::class, 'registration']);
Route::post('registration_process', [FrontController::class, 'registration_process'])->name('registration.registration_process');
Route::post('login_process', [FrontController::class, 'login_process'])->name('login.login_process');
Route::get('verification/{id}', [FrontController::class, 'email_verification']);
Route::post('forgot_password', [FrontController::class, 'forgot_password']);
Route::get('forgot_password_change/{id}', [FrontController::class, 'forgot_password_change']);
Route::post('forgot_password_change_process', [FrontController::class, 'forgot_password_change_process']);
Route::post('apply_coupon_code', [FrontController::class, 'apply_coupon_code']);
Route::post('remove_coupon_code', [FrontController::class, 'remove_coupon_code']);
Route::post('place_order', [FrontController::class, 'place_order']);
Route::get('checkout', [FrontController::class, 'checkout']);
Route::get('order_place', [FrontController::class, 'order_place']);
Route::get('/instamojo_payment_redirect', [FrontController::class, 'instamojo_payment_redirect']);


Route::post('product_review_process', [FrontController::class, 'product_review_process']);

Route::group(['middleware' => 'user_auth'], function () {
    Route::get('order', [FrontController::class, 'order']);
    Route::get('order_detail/{id}', [FrontController::class, 'order_detail']);

});
Route::get('logout', function () {
    session()->forget('FRONT_USER_LOGIN');
    session()->forget('FRONT_USER_ID');
    session()->forget('FRONT_USER_NAME');
    session()->forget('USER_TEMP_ID');
    return redirect('/');
});

//////////////////////// BAckend ///////////////////
Route::group(['middleware' => 'admin_auth'], function () {
    //Category//
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/manage_category', [CategoryController::class, 'manage_category']);
    Route::get('admin/category/manage_category/{id}', [CategoryController::class, 'manage_category']);
    Route::post('admin/category/manage_category_process', [CategoryController::class, 'manage_category_process'])->name('manage_category_process');
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);
    Route::get('admin/category/status/{type}/{id}', [CategoryController::class, 'status']);

    //Coupon//

    Route::get('admin/coupon', [CouponController::class, 'index']);
    Route::get('admin/coupon/manage_coupon', [CouponController::class, 'manage_coupon']);
    Route::get('admin/coupon/manage_coupon/{id}', [CouponController::class, 'manage_coupon']);
    Route::post('admin/coupon/manage_coupon_process', [CouponController::class, 'manage_coupon_process'])->name('manage_coupon_process');
    Route::get('admin/coupon/delete/{id}', [CouponController::class, 'delete']);
    Route::get('admin/coupon/status/{type}/{id}', [CouponController::class, 'status']);

    ///Size//
    Route::get('admin/size', [SizeController::class, 'index']);
    Route::get('admin/size/manage_size', [SizeController::class, 'manage_size']);
    Route::get('admin/size/manage_size/{id}', [SizeController::class, 'manage_size']);
    Route::post('admin/size/manage_size_process', [SizeController::class, 'manage_size_process'])->name('manage_size_process');
    Route::get('admin/size/delete/{id}', [SizeController::class, 'delete']);
    Route::get('admin/size/status/{type}/{id}', [SizeController::class, 'status']);

    ///colors///
    Route::get('admin/color', [ColorController::class, 'index']);
    Route::get('admin/color/manage_color', [ColorController::class, 'manage_color']);
    Route::get('admin/color/manage_color/{id}', [ColorController::class, 'manage_color']);
    Route::post('admin/color/manage_color_process', [ColorController::class, 'manage_color_process'])->name('manage_color_process');
    Route::get('admin/color/delete/{id}', [ColorController::class, 'delete']);
    Route::get('admin/color/status/{type}/{id}', [ColorController::class, 'status']);

    //product//
    Route::get('admin/product', [AdminController::class, 'dashboard']);
    Route::get('admin/product', [ProductController::class, 'index']);
    Route::get('admin/product/manage_product', [ProductController::class, 'manage_product']);
    Route::get('admin/product/manage_product/{id}', [ProductController::class, 'manage_product']);
    Route::post('admin/product/manage_product_process', [ProductController::class, 'manage_product_process'])->name('manage_product_process');
    Route::get('admin/product/delete/{id}', [ProductController::class, 'delete']);
    Route::get('admin/product/prod_attr_delete/{id}/{pid}', [ProductController::class, 'prod_attr_delete']);
    Route::get('admin/product/prod_images_delete/{id}/{pid}', [ProductController::class, 'prod_images_delete']);
    Route::get('admin/product/status/{type}/{id}', [ProductController::class, 'status']);

    //brand///////////

    Route::get('admin/brand', [BrandController::class, 'index']);
    Route::get('admin/brand/manage_brand', [BrandController::class, 'manage_brand']);
    Route::get('admin/brand/manage_brand/{id}', [BrandController::class, 'manage_brand']);
    Route::post('admin/brand/manage_brand_process', [BrandController::class, 'manage_brand_process'])->name('manage_brand_process');
    Route::get('admin/brand/delete/{id}', [BrandController::class, 'delete']);
    Route::get('admin/brand/status/{type}/{id}', [BrandController::class, 'status']);

    //banner///////////

    Route::get('admin/banner', [HomeBannerController::class, 'index']);
    Route::get('admin/banner/manage_banner', [HomeBannerController::class, 'manage_banner']);
    Route::get('admin/banner/manage_banner/{id}', [HomeBannerController::class, 'manage_banner']);
    Route::post('admin/banner/manage_banner_process', [HomeBannerController::class, 'manage_banner_process'])->name('manage_banner_process');
    Route::get('admin/banner/delete/{id}', [HomeBannerController::class, 'delete']);
    Route::get('admin/banner/status/{type}/{id}', [HomeBannerController::class, 'status']);

    //Tax   //
    Route::get('admin/tax', [TaxController::class, 'index']);
    Route::get('admin/tax/manage_tax', [TaxController::class, 'manage_tax']);
    Route::get('admin/tax/manage_tax/{id}', [TaxController::class, 'manage_tax']);
    Route::post('admin/tax/manage_tax_process', [TaxController::class, 'manage_tax_process'])->name('manage_tax_process');
    Route::get('admin/tax/delete/{id}', [TaxController::class, 'delete']);
    Route::get('admin/tax/status/{type}/{id}', [TaxController::class, 'status']);

    /////customer//////
    Route::get('admin/customer', [CustomerController::class, 'index']);
    Route::get('admin/customer/show/{id}', [CustomerController::class, 'show']);
    Route::get('admin/customer/delete/{id}', [CustomerController::class, 'delete']);
    Route::get('admin/customer/status/{type}/{id}', [CustomerController::class, 'status']);

    /////Order//////
    Route::get('admin/order', [OrderController::class, 'index']);
    Route::get('admin/order_detail/{id}', [OrderController::class, 'order_detail']);
    Route::get('admin/update_payment_status/{payment_status}/{id}', [OrderController::class, 'update_payment_status']);
    Route::get('admin/update_order_status/{order_status}/{id}', [OrderController::class, 'update_order_status']);
    Route::post('admin/order_detail/{id}', [OrderController::class, 'update_track_detail']);

    ////Product review///
    Route::get('admin/product_review', [ProductReviewController::class, 'index']);
    Route::get('admin/update_product_review_status/{status}/{id}', [ProductReviewController::class, 'update_product_review_status']);


    Route::get('admin/logout', function () {
        session()->forget('login');
        session()->forget('checklogin');
        session()->flash('error', 'User Logout');
        return redirect('admin');

    });
});
// Route::get('admin/logout', function () {
//     session()->forget('login');
//     session()->forget('checklogin');
//     return redirect('admin');
// });

Route::get('admin', [AdminController::class, 'index']);
Route::get('admin/updatepassword', [AdminController::class, 'updatepassword']);

Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');
