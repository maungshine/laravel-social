<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'post_image' => 'required|mimes:jpg,png,jpeg|max:5084',
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        $newimageName = time().'-'.$request->input('title').'.'.$request->file('post_image')->extension();

        $request->file('post_image')->move(public_path('images'), $newimageName);

        Post::create([
            "title" => $request->input('title'),
            "body" => $request->input('body'),
            "user_id" => Auth::user()->id,
            'post_image' => $newimageName,
            
        ]);

        return redirect('/');

            }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if(Auth::user() == $post->user){
            return view('posts.edit', compact('post'));
        }
        return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'post_image' => 'required|mimes:jpg,png,jpeg|max:5084',
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        

        
        $newimageName = time().'-'.preg_replace('/\s+/', '_', ($post->title)).'.'.$request->file('post_image')->extension();


        $request->file('post_image')->move(public_path('images'), $newimageName);
        
        Post::where('id', $post->id)
            ->update([
                'title' => $post->title,
                'body' => $post->body,
                'post_image' => $newimageName,
            ]);

        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
