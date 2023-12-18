<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function upload (Request $request) {
        $request->validate([
            'profile_picture' => 'required|mimes:jpg,png,jpeg|max:5084',
        ]);

        $newimageName = time().'-'.Auth::user()->name.'.'.$request->profile_picture->extension();

        $request->profile_picture->move(public_path('images'), $newimageName);
        
        User::where('id', Auth::user()->id)
            ->update(['profile_picture' => $newimageName]);

        return redirect()->route('viewProfile', ['user' => Auth::user()]);

    }

    public function edit () {
        return view('user.editProfile');
    }

    public function viewProfile(User $user) {
        $posts = Post::where('user_id', $user->id)->paginate(5);
        return view('user.profile', compact('posts', 'user'));
    }
}
