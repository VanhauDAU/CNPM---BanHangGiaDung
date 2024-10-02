<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Post;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    //
    private $post;
    const _PER_PAGE = 4;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function index2(){
        $title ='Danh Sách Bài Viết';
        $lists = $this->post->postBy();
        return view('admin.posts.index', compact('title','lists'));
    }
    public function index(Request $request){
        $title = 'DANH SÁCH BÀI VIẾT';
        $post = new Post();
        $filters =[];
        $keyword = null;
        if(!empty($request->nsx)){
            $ma_NSX = $request->nsx;
            $filters[] = ['sanpham.maNSX', '=',$ma_NSX];
        }
        if(!empty($request->id_danh_muc)){
            $nhom_SP = $request->id_danh_muc;
            $filters[] = ['sanpham.id_danh_muc', '=',$nhom_SP];
        }
        if(!empty($request->id_chuyen_muc)){
            $nhom_SP = $request->id_chuyen_muc;
            $filters[] = ['sanpham.id_chuyen_muc', '=',$nhom_SP];
        }
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
        }
        //Xử lý logic sắp xếp theo cột
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');
        $arrSort =['ASC', 'DESC'];
        if(!empty($sortType) & in_array($sortType,$arrSort)){
            if($sortType=='DESC'){
                $sortType ='ASC';
            }else{
                $sortType ='DESC';
            }
        }else{
            $sortType ='ASC';
        }
        $sortArr =[
            'sortBy'=>$sortBy,
            'sortType'=>$sortType
        ];
        //end xử lý
        $PostList = $post->getAllPosts($filters, $keyword,$sortArr, self::_PER_PAGE);
        return view('admin.posts.index', compact('title', 'PostList','sortType'));
    }
    public function add(){
        return view('admin.posts.add');

    }
    public function postAdd(Request $request){
        $request->validate([
            'tieu_de'=>'required',
            'noi_dung'=>'required'
        ],[
            'tieu_de.required'=>'Tiêu đề không được để trống',
            'noi_dung.required'=>'Nội dung không được để trống',
        ]);
        if ($request->has('anh_bia')) {
            $file = $request->anh_bia;  
            $ext = $file->getClientOriginalExtension();  
            $fileName = time().'-'.$ext;
            $file->move(public_path('storage/posts/img'), $fileName);
        }
        $post = new Post();
        $post->tieu_de = $request->tieu_de;
        $post->anh_bia = $request->anh_bia;
        $post->noi_dung = $request->noi_dung;
        $post->anh_bia = $fileName;
        $post->created_at = now();
        $post->user_id = Auth::user()->id;
        $post->trang_thai = $request->trang_thai;
        $post->slug = $request->slug;
        $post->save();
        return redirect()->route('admin.manage_post')->with('msg', 'Thêm mới bài viết thành công');
    }
    public function edit($post = 0){
        if(!empty($post)){
            $postDetail = $this->post->getDetail($post);
            if(!empty($postDetail[0])){
                $postDetail = $postDetail[0];
            }else{
                return redirect()->route('admin.manage_post')->with('msg','Bài viết không tồn tại!');
            }
        }else{
            return redirect()->route('admin.manage_post')->with('msg','Mã Bài Viết Không Tồn Tại');
        }
        return view('admin.posts.edit',compact('postDetail'));
    }
    public function postEdit(Request $request,$id = 0){
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $postsDetail = $this->post->getDetail($id);
        $fileName = null;
        if ($request->has('anh_bia')) {
            $file = $request->anh_bia;  
            $ext = $file->getClientOriginalExtension();  
            $fileName = time() . '-' . $ext;
            $file->move(public_path('storage/posts/img'), $fileName);
            if ($postsDetail && !empty($postsDetail->anh_bia)) {
                $oldImagePath = public_path('storage/posts/img/' . $postsDetail['anh']);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        } else {
            $fileName = $request->hinh_anh_cu;
        }
        $request->validate([
            'tieu_de' => 'required',
            'trang_thai' => 'required',
            'noi_dung' => 'required'
        ],[
            'tieu_de.required' => 'Tiêu đề bắt buộc phải nhập',
            'trang_thai.required' => 'Ảnh bắt buộc phải có',
            'noi_dung.required' => 'Nội dung bắt buộc phải nhập',
        ]);
        $dataUpdate = [
            $request->tieu_de,
            $fileName,
            $request->trang_thai,
            $request->noi_dung,
        ];
        $this->post->updatePost($dataUpdate, $id);
        return redirect()->route('getedit_post',['id'=>$id])->with('msg','Cập nhật bài viết thành công!');
    }
    public function delete($id = 0){
        if(!empty($id)){
            $postDetail = $this->post->getDetail($id);
            // dd($userDetail[0]);
            if(!empty($postDetail[0])){
                $deletepost = $this->post->deletePost($id);
                if($deletepost){
                    $msg = 'Xóa bài viết thành công';
                }else{
                    $msg = 'Bạn không thể xóa bài viết lúc này, vui lòng thử lại sau!';
                }
            }else{
                $msg ='Sản phẩm không tồn tại!';
            }
        }else{
            $msg = 'Liên kết không tồn tại';
        }
        if($msg ='Xóa bài viết thành công'){
            toastr()->success('Thành công','Xóa bài viết thành công');
        }else{
            toastr()->warning('Cảnh báo','Xóa bài viết thất bại');
        }
        return redirect()->route('admin.manage_post');
    }
}
