@extends('layouts.guest')

@section('content')
<div class="row">
  <div class="col-lg-4 col-md-8 col-12 mx-auto">
    <div class="card z-index-0 fadeIn3 fadeInBottom">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
          <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Register</h4>
        </div>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="input-group input-group-outline my-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="input-group input-group-outline my-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="input-group input-group-outline my-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <div class="input-group input-group-outline my-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Register</button>
          </div>
          <p class="mt-4 text-sm text-center">
            Already have an account?
            <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">Log in</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
