<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\comments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CommentController extends Controller
{
    //
    public function store(Request $request, $id) {
        // dd($request->all());
        if (Auth::check()) {
            $request->validate([
                'noi_dung' => 'required|max:255',
            ], [
                'noi_dung.required' => 'Bạn chưa nhập bình luận',
            ]);
            Comments::create([
                'user_id' => Auth::id(),
                'maSP' => $id,
                'noi_dung' => $request->noi_dung,
            ]);
            toastr()->success('Thành công', 'Bình luận của bạn đã gửi thành công!');
        } else {
            $request->validate([
                'ho_ten' => 'required|max:255',
                'so_dien_thoai' => 'required|max:15',
                'email' => 'required|email|max:255',
                'gioi_tinh' => 'required',
                'noi_dung' => 'required|max:255',
            ], [
                'ho_ten.required' => 'Bạn chưa nhập họ tên',
                'so_dien_thoai.required' => 'Bạn chưa nhập số điện thoại',
                'email.required' => 'Bạn chưa nhập email',
                'gioi_tinh.required' => 'Bạn chưa chọn giới tính',
                'noi_dung.required' => 'Bạn chưa nhập bình luận',
            ]);
            DB::table('khvanglai_binhluansp')->insert([
                'ho_ten' => $request->ho_ten,
                'so_dien_thoai' => $request->so_dien_thoai,
                'email' => $request->email,
                'gioi_tinh' => $request->gioi_tinh,
                'maSP' => $id,
                'noi_dung' => $request->noi_dung,
                'created_at' => now(),
                
            ]);
            toastr()->success('Thành công', 'Bình luận của bạn đã gửi thành công!');
        }
        return redirect()->back();
    }
}
