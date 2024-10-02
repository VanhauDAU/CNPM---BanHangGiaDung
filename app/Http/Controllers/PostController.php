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
        $PostList = DB::table('baiviet')
        ->get();
        return view('clients.post.index',compact('PostList'));
    }
    public function get_detail_post($id){
        $title = $id;
        $Post =DB::table('baiviet')
        ->where('baiviet.slug','=',$id)
        ->get();
        return view('clients.post.detailPost', compact('Post','title'));
    }
}
