<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function likePost(Post $post,User $user){
        $likedUsers = [];
        $likes = $post->likes->toArray();
        
        foreach($likes as $like) {
            $likedUsers[] = $like['user_id'];
        }

        if(!in_array($user->id, $likedUsers)){
        Like::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);
    }
        return redirect()->route('home');
    }

    public function unlikePost(Post $post,User $user){
        $likedUsers = [];
        $likes = $post->likes->toArray();
        
        foreach($likes as $like) {
            $likedUsers[] = $like['user_id'];
        }

        if(in_array($user->id, $likedUsers)){
            Like::where('post_id', $post->id)
                ->where('user_id', $user->id)
                ->delete();
        }
        

        return redirect()->route('home');
    }
}
