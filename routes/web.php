<?php

use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Notifications\OtpNotification;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Notification;
// use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\StaffController;
// user
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Clients\ContactController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Clients\ShoppingCartController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\clients\PaymentController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Auth\LoginController as LoginController1;
//product user
use App\Http\Controllers\Admin\PostController as PostControllerAdmin;
use App\Http\Controllers\Clients\LoginController as UserLoginController;
use App\Http\Controllers\Clients\UserController as UserControllerClients;
use App\Http\Controllers\Clients\ProductController as ProductControllerUser;
use App\Models\Admin\Post;
use App\Models\User;
use App\Models\Admin\Staffs;

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
        toastr()->success('Thành công','Đăng xuất thành công');
        return redirect()->route('admin.login');
    })->name('admin.logout');
    Route::middleware('auth.admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::prefix('quan-ly-nguoi-dung')->name('users.')->middleware('can:users')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('index');

            Route::get('info_detail/{user}', [UserController::class, 'detail'])->name('detail');

            Route::get('add', [UserController::class, 'add'])->name('add')->can('create',User::class);

            Route::post('add', [UserController::class, 'postAdd'])->can('create',User::class);

            Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit')->can('update', User::class);
            
            Route::post('edit/{user}', [UserController::class, 'postEdit']);

            Route::delete('delete/{user}', [UserController::class, 'delete'])->name('delete');
        });
        Route::prefix('quan-ly-chuc-vu')->name('staffs.')->middleware('can:staffs')->group(function () {
            Route::get('', [StaffController::class, 'index'])->name('index');

            Route::get('add', [StaffController::class, 'add'])->name('add')->can('staffs.add');

            Route::post('add', [StaffController::class, 'postAdd'])->can('staffs.add');

            Route::get('edit/{staff}', [StaffController::class, 'edit'])->name('edit')->can('staffs.edit');

            Route::post('edit/{staff}', [StaffController::class, 'postEdit']);

            Route::delete('delete/{staff}', [StaffController::class, 'delete'])->name('delete')->can('staffs.delete');

            Route::get('phan-quyen/{staff}', [StaffController::class, 'phanQuyen'])->name('phanQuyen');

            Route::post('phan-quyen/{staff}', [StaffController::class, 'postPhanQuyen']);
        });
        Route::prefix('quan-ly-san-pham')->name('products.')->middleware('can:products')->group(function () {
            Route::get('', [ProductController::class, 'index'])->name('index');
            Route::get('info_detail/{id}', [ProductController::class, 'detailProduct'])->name('detailProduct');
            Route::prefix('add')->group(function(){
                Route::get('', [ProductController::class, 'addProduct'])->name('addProduct');
                Route::post('', [ProductController::class, 'postAddProduct']);

                Route::get('nha-san-xuat', [ProductController::class, 'addNsx'])->name('addNsx');
                Route::post('nha-san-xuat', [ProductController::class, 'postAddNSX']);
                Route::delete('delete-nsx/{id}', [ProductController::class, 'deleteNsx'])->name('deleteNsx');

                Route::get('danh-muc', [ProductController::class, 'addDm'])->name('addDm');
                Route::post('danh-muc', [ProductController::class, 'postAddDm']);
                Route::delete('delete-dm/{id}', [ProductController::class, 'deleteDm'])->name('deleteDm');

                Route::get('chuyen-muc', [ProductController::class, 'addCm'])->name('addCm');
                Route::post('chuyen-muc', [ProductController::class, 'postAddCm']);

                Route::get('chuyen-muc-nsx', [ProductController::class, 'addCmNsx'])->name('addCmNsx');
                Route::post('chuyen-muc-nsx', [ProductController::class, 'postAddCmNsx']);

            });
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::post('edit/{id}', [ProductController::class, 'postEdit']);
            Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('delete');
        });
        Route::prefix('quan-ly-bai-viet')->name('posts.')->middleware('can:posts')->group(function () {
            Route::get('', [PostControllerAdmin::class, 'index'])->name('index');

            Route::get('add', [PostControllerAdmin::class, 'add'])->name('add')->can('create',Post::class);

            Route::post('add', [PostControllerAdmin::class, 'postAdd'])->can('create',Post::class);

            Route::get('edit/{post}', [PostControllerAdmin::class, 'edit'])->name('edit')->can('posts.edit');
            
            Route::post('edit/{post}', [PostControllerAdmin::class, 'postEdit']);

            Route::post('delete-any', [PostControllerAdmin::class, 'handelDeleteAny'])->name('deleteAny');

            Route::get('restore/{id}',[PostControllerAdmin::class, 'restore'])->name('restore');

            Route::get('force-delete/{id}',[PostControllerAdmin::class, 'forceDelete'])->name('forceDelete');

        });
        Route::prefix('quan-ly-binh-luan')->name('comments.')->middleware('can:comments')->group(function () {
            Route::get('', [CommentController::class, 'index'])->name('index');

            Route::get('edit/{id}', [CommentController::class, 'edit'])->name('edit');

            Route::post('edit/{id}', [CommentController::class, 'postEdit']);

            Route::delete('delete/{id}', [CommentController::class, 'delete'])->name('delete');
        });
        Route::prefix('quan-ly-hoa-don')->name('bills.')->middleware('can:bills')->group(function () {
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
        Route::get('/{id_danh_muc}/{id_chuyen_muc}/{id_NSX}', [ProductControllerUser::class, 'show3'])->name('sanpham_id_id_id');
    });
    Route::get('chi-tiet-san-pham/{id}', [ProductControllerUser::class, 'detail_product'])->name('chi_tiet_sp');
    Route::post('/chi-tiet-san-pham/{id}/comment', [CommentController::class, 'store'])->name('chi_tiet_sp.comment');
    Route::post('/comments/reply', [CommentController::class, 'reply'])->name('comment.reply');
    Route::post('lien-he', [ContactController::class, 'post_add_contact'])->name('lien-he');
    Route::get('lien-he', [ContactController::class, 'get_add_contact'])->name('post_lien-he');
    Route::get('bai-viet',[PostController::class,'post'])->name('bai-viet');
    Route::get('bai-viet/{id}',[PostController::class,'get_detail_post'])->name('get_bai_viet');
    Route::prefix('tai-khoan')->group(function(){
        Route::get('',[UserControllerClients::class,'get_info_user'])->name('info-user');
        Route::get('/edit', [UserControllerClients::class,'edit'])->name('info-user.edit');
        Route::post('/edit', [UserControllerClients::class,'update'])->name('info-user.update');

        Route::get('dia-chi',[UserControllerClients::class,'get_info_address'])->name('info-user-address');

        Route::get('doi-mat-khau', [UserControllerClients::class,'password_edit'])->name('password-user.edit');
        Route::post('doi-mat-khau', [UserControllerClients::class,'password_update']);

    });
    Route::prefix('gio-hang')->name('cart.')->group(function(){
        Route::get('/', [ShoppingCartController::class, 'index'])->name('index');
        Route::post('add/{id}', [ShoppingCartController::class, 'add'])->name('add');
        Route::post('update', [ShoppingCartController::class, 'update'])->name('update');
        Route::get('/remove/{rowId}', [ShoppingCartController::class, 'remove'])->name('remove');
        Route::get('/destroy', [ShoppingCartController::class, 'destroy'])->name('destroy');
    });
    // Route::post('/pay-to-cart/{id}', [ShoppingCartController::class, 'payToCart'])->name('pay.add');
    

    Route::prefix('/thanh-toan')->name('pay.')->group(function(){
        Route::get('', [PaymentController::class, 'index'])->name('index');
        Route::post('', [PaymentController::class, 'postPayment']);
        // Route::post('', [PaymentController::class, 'postPayment']);
    });

    Route::get('nhan-hang/{id}', [BrandController::class, 'getBrand'])->name('getBrand');
    
});
Route::get('/fetch-chuyen-muc/{maNSX}/{id_danh_muc}',  [ProductController::class, 'getChuyenMuc'])->name('getChuyenMuc');
Route::get('/getDanhMuc/{id}', [ProductController::class, 'getDanhMuc'])->name('getDanhMuc');

//Học model
Route::prefix('posts')->name('posts.')->group(function(){
    Route::get('/', [PostController::class,'index'])->name('index');
});
Auth::routes();
Auth::routes(['verify' => true]);
Route::get('test-otp', function(){
    // $otp = (new Otp)->generate('levanhaum@gmail.com','numeric', 4, 10);
    // $otp = (new Otp)->validate('levanhaum@gmail.com', 4035);
    // $otp = generateOtp('levanhaum@gmail.com');
    // dd(validateOtp('levanhaum@gmail.com',7396));
    // Notification::route('mail','levanhaum@gmail.com')->notify(new OtpNotification($otp));
    // dd($otp);
}); 
// Route::get('2fa',function(){
//     return '<h2>2FA</h2>';
// })->name('2fa');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/email/verify',function(){
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/')->with('success','Đã xác thực email thành công!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('success','Đã gửi lại email xác thực!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('auth/google/callback',[LoginController1::class,'googleCallBack']);