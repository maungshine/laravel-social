@extends('layout.layout')
@section('content')
<form action="{{ route('post.update', ['post' => $post]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title"  class="form-label">Title</label>
        <input type="title" value="{{ $post->title }}" class="form-control" id="title" placeholder="Title.." name="title">
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control" id="body" name="body" rows="3">{{ $post->body }}</textarea>
        @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>
      <div class="mb-3">

        
        <label for="post_image"  class="form-label">Image</label>
        <input type="file" class="form-control" id="post_image" name="post_image">


        @error('post_image')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Update</button>
      </div>
</form>
@endsection