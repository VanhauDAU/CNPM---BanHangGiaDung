<?php

namespace App\Http\Controllers\Admin;

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
    public function postEdit(Post $post,Request $request){
        
    }
    public function delete(Post $post){

    }
}
