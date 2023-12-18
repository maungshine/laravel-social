<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function commentPost(Request $request, $post_id, $user_id){
        $request->validate([
            'body' => 'required'
        ]);

        Comment::create([
            'body' => $request->input('body'),
            'post_id' => $post_id,
            'user_id' => $user_id,
        ]);

        return redirect()->route('home');
    }
}
