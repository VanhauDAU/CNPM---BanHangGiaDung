<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    //
    public function index(){
        $post = new Post;
        // $post->title = 'Bai Viet 4';
        // $post->content = 'Noi Dung 4';
        // $post->status = 1; 
        // dd($post);
        // $post->save();
        $posts =$post::all();
        
    }
    public function post(){
        $Post = Post::all();
        // dd($Post);
        return view('clients.post.index',compact('Post'));
    }
    public function get_detail_post($id){
        $title = $id;
        if(!empty($id)){
            $Post =DB::table('baiviet')
            ->select('baiviet.*','taikhoan.ho_ten')
            ->join('taikhoan','taikhoan.id','=','baiviet.user_id')
            ->where('baiviet.slug','=',$id)
            ->get();
            // dd($Post);
            if(!empty($Post)){
                $Post = $Post[0];
            }
        }
        // dd($Post);
        return view('clients.post.detailPost', compact('Post','title'));
    }
}
