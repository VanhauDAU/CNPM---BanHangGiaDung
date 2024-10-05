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
    private $comments;
    public function __construct()
    {
        $this->comments = new comments();
    }
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
                'provider' => null,
            ]);
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

            Comments::create([
                'user_id' => null,
                'maSP' => $id,
                'ho_ten_KHVL' => $request->ho_ten,
                'so_dien_thoai_KHVL' => $request->so_dien_thoai,
                'email_KHVL' => $request->email,
                'gioi_tinh_KHVL' => $request->gioi_tinh,
                'noi_dung' => $request->noi_dung,
            ]);
        }
        return redirect()->back()->with('success','Bình luận của bạn đã được gửi, chờ phê duyệt!');
    }
    public function index() {
        $title = 'QUẢN LÝ BÌNH LUẬN';
    
        $commentList = DB::table('binhluansp')
        ->select('taikhoan.ho_ten', 'binhluansp.*', 'sanpham.ten_san_pham', 'sanpham.slug')
        ->join('sanpham', 'sanpham.maSP', '=', 'binhluansp.maSP')
        ->leftJoin('taikhoan', 'taikhoan.id', '=', 'binhluansp.user_id')
        ->orderBy('created_at','DESC')
        ->get();
        // dd($commentList);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 7; 
        $currentItems = $commentList->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $commentList = new LengthAwarePaginator($currentItems, $commentList->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        
        return view('admin.comments.index', compact('title', 'commentList'));
    }
    public function edit($id){
        $title = "CẬP NHẬT BÀI VIẾT";
        if(!empty($id)){
            $cmtDetail = DB::table('binhluansp')
            ->select('taikhoan.*', 'binhluansp.*', 'sanpham.ten_san_pham', 'sanpham.slug')
            ->join('sanpham', 'sanpham.maSP', '=', 'binhluansp.maSP')
            ->leftJoin('taikhoan', 'taikhoan.id', '=', 'binhluansp.user_id')
            ->where('binhluansp.id','=',$id)
            ->orderBy('binhluansp.created_at','DESC')
            ->get();
            // dd($cmtDetail);
            if(!empty($cmtDetail[0])){
                $cmtDetail = $cmtDetail[0];
            }else{
                return redirect()->route('admin.manage_user')->with('msg','Bình luận không tồn tại!');
            }
        }else{
            return redirect()->route('admin.manage_user')->with('msg','Mã Bình luận Không Tồn Tại');
        }
        return view('admin.comments.edit', compact('title','cmtDetail'));
    }
    public function cmtEdit(Request $request, $id)
    {
        if (empty($id)) {
            return back()->with('msg', 'Liên kết không tồn tại');
        }

        $updated = DB::table('binhluansp')
            ->where('id', $id)
            ->update([
                'trang_thai' => $request->trang_thai,
                'updated_at' => now(),
            ]);

        if ($updated) {
            toastr()->success('Thành công', 'Cập nhật trạng thái thành công!');
        } else {
            toastr()->error('Thất bại', 'Cập nhật trạng thái không thành công!');
        }

        return redirect()->route('getedit_cmt', ['id' => $id]);
    }

    public function delete($id)
    {
        if (!empty($id)) {
            $userDetail = DB::table('binhluansp')->where('id', $id)->first();

            if (!empty($userDetail)) {
                $deleteuser = DB::table('binhluansp')->where('id', $id)->delete();

                if ($deleteuser) {
                    $msg = 'Xóa bình luận thành công';
                    toastr()->success('Thành công', $msg);
                } else {
                    $msg = 'Bạn không thể xóa bình luận lúc này, vui lòng thử lại sau!';
                    toastr()->error('Thất bại', $msg);
                }
            } else {
                $msg = 'Bình luận không tồn tại!';
                toastr()->warning('Cảnh báo', $msg);
            }
        } else {
            $msg = 'Liên kết không tồn tại';
            toastr()->warning('Cảnh báo', $msg);
        }

        return redirect()->route('admin.manage_cmt')->with('msg', $msg);
    }


}
