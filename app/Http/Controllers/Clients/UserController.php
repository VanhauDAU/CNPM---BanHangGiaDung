<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    private $Users;
    public function __construct()
    {
        
    }
    public function get_info_user(){
        $title = 'THÔNG TIN CÁ NHÂN';
        return view('clients.account.index', compact('title')); 
    }
    public function get_info_address(){
        $title = 'THÔNG TIN CÁ NHÂN';
        return view('clients.account.address', compact('title'));
    }
    public function password_edit(){
        $title= 'ĐỔI MẬT KHẨU';
        return view('clients.account.changePassword', compact('title'));
    }
    public function password_update(Request $request)
    {
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            toastr()->warning('Kiểm tra lại', 'Mật khẩu cũ không chính xác');
            return back();
        }
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ], [
            'old_password.required' => 'Mật khẩu cũ bắt buộc phải nhập',
            'password.required' => 'Mật khẩu mới bắt buộc phải nhập',
            'confirm_password.required' => 'Mật khẩu xác nhận bắt buộc phải nhập',
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp với mật khẩu mới',
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save(); 
        toastr()->success('Thành công', 'Cập nhật mật khẩu thành công!');
        return back();
    }

    public function edit()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra kiểu dữ liệu
        if (!$user instanceof User) {
            abort(404, 'User not found');
    }
        return view('clients.account.editInfo', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:15',
            'ngay_sinh' => 'nullable|date',
            'gioi_tinh' => 'nullable|string|max:10',
        ]);

        // Cập nhật thông tin người dùng
        $user = Auth::user();
        $user->ho_ten = $request->ho_ten;
        $user->so_dien_thoai = $request->so_dien_thoai;
        $user->ngay_sinh = $request->ngay_sinh;
        $user->gioi_tinh = $request->gioi_tinh;
        $user->save();
        toastr()->success('Thành công','Cập nhật thông tin thành công!');
        return redirect()->route('home.info-user');
    }
}
