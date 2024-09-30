<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\HomeController;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\StaffController;
// use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\Auth\LoginController;
// user
use App\Http\Controllers\Clients\LoginController as UserLoginController;
use App\Http\Controllers\Clients\ShoppingCartController;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\LoginController as LoginController1;
use App\Http\Controllers\Clients\ContactController;
//product user
use App\Http\Controllers\Clients\ProductController as ProductControllerUser;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->middleware('guest:admin')->name('admin.login');
    Route::post('login', [LoginController::class, 'post_login'])->middleware('guest:admin');
    Route::post('logout', function () {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    })->name('admin.logout');
    Route::middleware('auth.admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::prefix('quan-ly-nguoi-dung')->group(function () {
            Route::get('', [UserController::class, 'manage_user'])->name('admin.manage_user');
            Route::get('info_detail/{id}', [UserController::class, 'get_info_detail'])->name('info');
            Route::get('add', [UserController::class, 'get_add_user'])->name('getadd_user');
            Route::post('add', [UserController::class, 'post_add_user'])->name('admin.add_user');
            Route::get('edit/{id}', [UserController::class, 'get_edit_user'])->name('getedit_user');
            Route::post('edit/{id}', [UserController::class, 'post_edit_user'])->name('admin.edit_user');
            Route::delete('delete/{id}', [UserController::class, 'get_delete_user'])->name('getdelete_user');
        });
        Route::prefix('quan-ly-san-pham')->group(function () {
            Route::get('', [ProductController::class, 'manage_product'])->name('admin.manage_product');
            Route::get('info_detail/{id}', [ProductController::class, 'get_info_detail'])->name('product.info');
            Route::prefix('add')->group(function(){
                Route::get('', [ProductController::class, 'get_add_product'])->name('getadd_product');
                Route::post('', [ProductController::class, 'post_add_product'])->name('admin.add_product');
                Route::get('nha-san-xuat', [ProductController::class, 'get_add_NSX'])->name('getadd_nsx');
                Route::post('nha-san-xuat', [ProductController::class, 'post_add_NSX'])->name('admin.add_nsx');
                Route::get('danh-muc', [ProductController::class, 'get_add_DM'])->name('getadd_dm');
                Route::post('danh-muc', [ProductController::class, 'post_add_DM'])->name('admin.add_dm');
            });
            Route::get('edit/{id}', [ProductController::class, 'get_edit_product'])->name('getedit_product');
            Route::post('edit/{id}', [ProductController::class, 'post_edit_product'])->name('postedit_product');
            Route::delete('delete/{id}', [ProductController::class, 'get_delete_product'])->name('getdelete_product');
        });
        Route::prefix('quan-ly-hoa-don')->group(function () {
            Route::get('', [OrderController::class, 'manage_order'])->name('admin.manage_order');
            Route::get('add', [OrderController::class, 'get_add_order'])->name('getadd_order');
            Route::post('add', [OrderController::class, 'post_add_order'])->name('admin.add_order');
            Route::get('edit/{id}', [OrderController::class, 'get_edit_order'])->name('getedit_order');
            Route::post('edit/{id}', [OrderController::class, 'post_edit_order'])->name('admin.edit_order');
            Route::delete('delete/{id}', [OrderController::class, 'get_delete_order'])->name('getdelete_order');
        });
        Route::prefix('info')->group(function () {
            Route::get('', [DashboardController::class, 'get_info_detail'])->name('admin.info');
        });
    });
});
//========================user================================
Route::prefix('/')->name('home.')->group(function(){
    Route::get('',[HomeController::class, 'index'])->name('index');
    Route::prefix('san-pham')->name('products.')->group(function(){
        Route::get('', [ProductControllerUser::class, 'index'])->name('index');
        Route::get('/{id}', [ProductControllerUser::class, 'show'])->name('sanpham_id');
        Route::get('/{id_danh_muc}/{id_chuyen_muc}', [ProductControllerUser::class, 'show2'])->name('sanpham_id_id');
        
    });
    Route::get('chi-tiet-san-pham/{id}', [ProductControllerUser::class, 'detail_product'])->name('chi_tiet_sp');
    Route::post('lien-he', [ContactController::class, 'post_add_contact'])->name('lien-he');
    Route::get('lien-he', [ContactController::class, 'get_add_contact'])->name('post_lien-he');
    Route::get('gio-hang',[ShoppingCartController::class,'giohang'])->name('gio-hang');
    Route::get('/api/chuyen-muc/{id_danh_muc}', [ProductControllerUser::class, 'getChuyenMuc']);
});
//Học model
Route::prefix('posts')->name('posts.')->group(function(){
    Route::get('/', [PostController::class,'index'])->name('index');
});
Auth::routes();
Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/email/verify',function(){ 
//     return view('auth.verify');
// })->middleware('auth')->name('verification.notice');
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('auth/google/callback',[LoginController1::class,'googleCallBack']);