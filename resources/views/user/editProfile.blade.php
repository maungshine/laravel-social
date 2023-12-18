@extends('layout.layout')
@section('content')

<form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="profile_picture">Upload profile</label>
    <input type="file" name="profile_picture" id="profile_picture">
    <button type="submit"> Upload</button>
</form>

@endsection