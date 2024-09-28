<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

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
}
