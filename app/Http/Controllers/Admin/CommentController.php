<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\comments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

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
    public function index() {
        $title = 'QUẢN LÝ BÌNH LUẬN';
    
        $comment1 = DB::table('binhluansp')
            ->select('taikhoan.ho_ten', 'binhluansp.*', 'sanpham.ten_san_pham', 'sanpham.slug')
            ->join('sanpham', 'sanpham.maSP', '=', 'binhluansp.maSP')
            ->join('taikhoan', 'taikhoan.id', '=', 'binhluansp.user_id')
            ->get();

        $comment2 = DB::table('khvanglai_binhluansp')
            ->select('khvanglai_binhluansp.*', 'sanpham.ten_san_pham', 'sanpham.slug as slug')
            ->join('sanpham', 'sanpham.maSP', '=', 'khvanglai_binhluansp.maSP')
            ->get();

        $commentList = $comment1->merge($comment2);
        // dd($commentList);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5; 
        $currentItems = $commentList->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $commentList = new LengthAwarePaginator($currentItems, $commentList->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
    
        return view('admin.comments.index', compact('title', 'commentList'));
    }
    
    public function add(){

    }
    public function cmtAdd(Request $request){

    }
    public function edit($id){

    }
    public function cmtEdit(Request $request, $id){

    }
    public function delete($id){
        
    }

}
