@extends('layouts.app_login')

@section('header')
@endsection

@section('content')
  <div class="container">
    <div class="login-form">
      <form method="POST" action="{{ route('signin.check') }}" aria-label="{{ __('Login') }}" role="login" autocomplete="off">
          @csrf
          <img src="assets/images/background/logo.png" class="img-fluid" alt="" />
          <hr style="margin: 10px 0;">
          @if ($errors->has('name'))
            <div class="alert alert-warning">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>{{ $errors->first('name') }}</strong>
            </div>
          @elseif ($errors->has('password'))
            <div class="alert alert-warning">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>{{ $errors->first('password') }}</strong>
            </div>
          @endif

          <input id="name" type="text" class="form-control input-lg marginv-16{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Username" onkeyup="this.value = this.value.toUpperCase();" required autofocus>

          <input id="password" type="password" class="form-control input-lg marginv-16{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

          {{-- @if (session()->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ session()->get('password') }}</strong>
              </span>
          @endif --}}
{{-- <hr> --}}
          <button type="submit" class="btn btn-lg btn-primary btn-block">
              {{ __('Login') }}
          </button>
      </form>
    </div>
  </div>
@endsection

@section('footer')
@endsection