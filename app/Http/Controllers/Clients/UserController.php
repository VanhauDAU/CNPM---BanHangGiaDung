<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //
    public function __construct()
    {
        
    }
    public function get_info_user(){
        $title = 'THÔNG TIN CÁ NHÂN';
        return view('clients.infoUser.index', compact('title'));
    }
    public function get_info_address(){
        $title = 'THÔNG TIN CÁ NHÂN';
        return view('clients.infoUser.address', compact('title'));
    }
    public function edit()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra kiểu dữ liệu
        if (!$user instanceof User) {
            abort(404, 'User not found');
    }
        return view('clients.infoUser.editInfo', compact('user'));
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
