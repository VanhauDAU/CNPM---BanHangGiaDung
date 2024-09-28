<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function login(){
        if(Auth::guard('admin')->check()){
            $adminInfo = Auth::guard('admin')->user();
        }
        return view('admin.auth.login');
    }
    public function post_login(Request $Request){
        $dataLogin = request()->except(['_token']);
        if(isAdminActive($dataLogin['username'])){
            $checkLogin = Auth::guard('admin')->attempt($dataLogin);
            if($checkLogin){
               return redirect(RouteServiceProvider::ADMIN);
            }
            return back()->with('msg','Tài khoản hoặc mật khẩu không hợp lệ');
        }
        return back()->with('msg', 'Tài khoản chưa được kích hoạt');
    }
}
