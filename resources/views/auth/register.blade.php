@extends('layout.layout')
@section('content')
<form action="{{ route('registerUser') }}" method="POST">
  @csrf
    <h1 class="h3 mb-3 fw-normal">Register</h1>
    <div class="form-floating">
        <input type="text" name="username" class="form-control" id="username" placeholder="name@example.com">
        <label for="username">Username</label>
      </div>
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
      <label for="email">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div><div class="form-floating">
        <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" placeholder="confirmpassword">
        <label for="confirmPassword">Confirm Password</label>
      </div>
    <button class="btn btn-primary w-100 py-2" type="submit">
      Register
    </button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
  </form>
@endsection