<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use App\Models\Following_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function follow(Request $request, User $user){
    
        if(!in_array($user, Auth::user()->followers->toArray())){
            Follower::create([
                'user_id' => $user->id,
                'follower' => Auth::user()->id,
            ]);
    
            Following_users::create([
                'user_id' => Auth::user()->id,
                'followingUser' => $user->id,
            ]);
            return redirect()->route('viewProfile', ['user'=> $user->id]);
        }
        return redirect()->route('viewProfile', ['user'=> $user->id])->withErrors([
            'errors' => 'You already followed the user!'
        ]);
    }

    public function unfollow(Request $request, User $user) {
        if(!in_array($user, Auth::user()->followers->toArray())){

            Follower::where('user_id', $user->id)->delete();
            Following_users::where('followingUser', $user->id)->delete();

            return redirect()->route('viewProfile', ['user'=> $user->id]);
        }
        return redirect()->route('viewProfile', ['user'=> $user->id])->withErrors([
            'error' => 'You have not followed the user yet!'
        ]);
    }
}
