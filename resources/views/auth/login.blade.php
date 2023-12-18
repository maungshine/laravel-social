@extends('layout.layout')
@section('content')


<form action="{{ route('loginUser') }}" method="POST">
  @csrf
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
      <label for="email">Email address</label>
      @error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
      @error('password')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
  </form>
@endsection