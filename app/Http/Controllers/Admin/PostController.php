<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    //
    private $post;
    const _PER_PAGE = 4;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function index(Request $request){
        $this->authorize('viewAny', Post::class);
        $title = 'DANH SÁCH BÀI VIẾT';
        $post = new Post();
        $userId = Auth::user()->id;
        // $user = Auth::user();
        $PostList = $post->withTrashed()
        ->select('baiviet.*','taikhoan.ho_ten')
        ->join('taikhoan','taikhoan.id','=','baiviet.user_id')
        ->orderBy('created_at','DESC')
        // ->where('baiviet.user_id',$userId)
        ->get();
        // if($user->can('viewAny',Post::class)){
        //     return view('admin.posts.index', compact('title', 'PostList'));
        // }
        // if($user->cant('viewAny',Post::class)){
        //     abort(403);
        // }
        return view('admin.posts.index', compact('title', 'PostList'));
    }
    public function add(){
        $this->authorize('viewAny', Post::class);
        // if(Gate::allows('posts.add')){
        //     return 'Có quyền thêm bài viết';
        // }
        // if(Gate::denies('posts.add')){
        //     return 'Bạn không có quyền truy cập';
        // }
        return view('admin.posts.add');
    }
    public function postAdd(Request $request){
        $request->validate([
            'tieu_de'=>'required',
            'anh_bia'=>'required',
            'noi_dung'=>'required',
            'slug'=>'unique:baiviet,slug'
        ],[
            'tieu_de.required'=>'Tiêu đề không được để trống',
            'anh_bia.required'=>'Ảnh bìa không được để trống',
            'noi_dung.required'=>'Nội dung không được để trống',
            'slug.unique'=>'Đường dẫn đã tồn tại, vui lòng đổi tiêu đề'
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
        $post->updated_at = null;
        $post->user_id = Auth::user()->id;
        $post->slug = $request->slug;
        $post->save();
        return redirect()->route('admin.posts.index')->with('msg', 'Thêm mới bài viết thành công');
    }
    public function edit(Post $post) {
        $this->authorize('update',$post);
        if(!empty($post)){
            $postDetail = $this->post->getDetail($post->id_bai_viet);
            if(!empty($postDetail[0])){
                $postDetail = $postDetail[0];
            }else{
                return redirect()->route('admin.posts.index')->with('msg','Bài viết không tồn tại!');
            }
        }else{
            return redirect()->route('admin.posts.index')->with('msg','Mã Bài Viết Không Tồn Tại');
        }
        return view('admin.posts.edit',compact('postDetail'));
    }
    public function postEdit(Request $request,$id = 0){
        $post = $this->post->find($id);
        $this->authorize('update',$post);
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
        $existingPost = DB::table('baiviet')
            ->where('slug', $request->slug)
            ->where('id_bai_viet', '!=', $id)
            ->first();

        if ($existingPost) {
            toastr()->warning('Thất bại','Đường dẫn đã tồn tại!');
            return back();
        }
        $request->validate([
            'tieu_de' => 'required',
            'trang_thai' => 'required',
            'noi_dung' => 'required'
        ],[
            'tieu_de.required' => 'Tiêu đề bắt buộc phải nhập',
            'trang_thai.required' => 'Ảnh bắt buộc phải có',
            'noi_dung.required' => 'Nội dung bắt buộc phải nhập'
        ]);
        $dataUpdate = [
            $request->tieu_de,
            $fileName,
            $request->trang_thai,
            $request->noi_dung,
            $request->slug,
        ];
        // dd($dataUpdate);
        $this->post->updatePost($dataUpdate, $id);
        return redirect()->route('admin.posts.edit',['post'=>$id])->with('msg','Cập nhật bài viết thành công!');
    }
    public function handelDeleteAny(Post $post, Request $request){
        $deleteArr = $request->delete;
        if(!empty($deleteArr)){
            $posts = Post::whereIn('id_bai_viet', $deleteArr)->get();
            foreach ($posts as $post) {
                $this->authorize('delete', $post);
            }
            $status = Post::destroy($deleteArr);
            if($status){
                $msg ='Đã xóa '.count($deleteArr).' bài viết';
            }else{
                $msg ='Bạn không thể xóa vào lúc này, vui lòng thử lại sau!';
            }
        }else{
            $msg ='Vui lòng chọn bài viết muốn xóa';
        }
        toastr()->warning('Thông báo',$msg);
        return redirect()->route('admin.posts.index');
    }
    public function restore($id){
        $status = Post::withTrashed()->where('id_bai_viet',$id)->first();
        if(!empty($status)){
            $status->restore();
            toastr()->success('Thành công','Khôi phục thành công!');
            return redirect()->route('admin.posts.index');
        }
    }
    public function forceDelete(Post $post,$id){
        $post = $this->post->find($id);
        $this->authorize('delete',$post);
        dd($post);
        $Post = Post::onlyTrashed()->where('id_bai_viet',$id)->first();
        if(!empty($Post)){
            $Post->forceDelete();
            toastr()->success('Thành công','Đã xóa vĩnh viễn bài viết');
            return redirect()->route('admin.posts.index');
        }
        toastr()->warning('Thất bại','Không thể xóa bài viết');
        return redirect()->route('admin.posts.index');
    }
}
