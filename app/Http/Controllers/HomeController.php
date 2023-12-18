<?php

namespace App\Http\Controllers;

use App\Models\Following_users;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('home', ['posts' => $posts]);
    }

    public function followingFeeds(){
        $followingUsersIds = [];
        $followingUsers = Auth::user()->following_users->toArray();
        
        foreach($followingUsers as $followingUser) {
            $followingUsersIds[] = $followingUser['followingUser'];
        }
        $posts = Post::orderBy('created_at', 'desc')
                    ->whereIn('user_id', $followingUsersIds )
                    ->paginate(10);
        return view('followingFeeds', ['posts' => $posts]);
    }

    public function search() {
        if (request('search')) {
            $posts = Post::where('title', 'like', '%' . request('search') . '%')->paginate(10);
        } else {
            $posts = Post::all();
        }
    
        return view('home', ['posts' => $posts]);
    }
}
