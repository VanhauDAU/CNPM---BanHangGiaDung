<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin\Post;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function add(){
        return true;
    }
    public function edit(User $user,Post $post){
        return $user->id == $post->user_id;
    }
}
