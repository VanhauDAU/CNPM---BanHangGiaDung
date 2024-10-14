<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function login(){
        // if(Auth::guard('admin')->check()){
        //     $adminInfo = Auth::guard('admin')->user();
        // }
        return view('admin.auth.login');
    }
    public function post_login(Request $Request){
        $dataLogin = request()->except(['_token']);
        $user = User::where('username', $dataLogin['username'])->first();
        $isAuth = true;
        if (!$user || $user->loai_tai_khoan != 1) {
          $isAuth = false;
        } else {
            $isAuth =  Auth::attempt($dataLogin);
        }

        if (!$isAuth) {
            return back()->with('msg','Tài khoản hoặc mật khẩu không hợp lệ');
        }
      
        return redirect()->route('admin.index');
    }
}
