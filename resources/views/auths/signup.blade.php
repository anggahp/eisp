@extends('layouts.app_home')

@section('header')

@endsection

@section('content')
<div class="main-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('signup.store') }}" autocomplete="off">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" onkeyup="this.value = this.value.toUpperCase();" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

                                <div class="col-md-6">
                                    <select  class="form-control" id="user_type" name="user_type">
                                        {{-- <option value="-"> PILIH TYPE </option> --}}
                                        <option value="user">USER</option>
                                        @if (Auth::user()->user_grp == 'all')
                                        <option value="admin">ADMIN</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_grp" class="col-md-4 col-form-label text-md-right">{{ __('User Group') }}</label>

                                <div class="col-md-6">
                                    <select  class="form-control" id="user_grp" name="user_grp">
                                        {{-- <option value="-"> PILIH GROUP </option> --}}
                                        @if (Auth::user()->user_grp == 'supp' || Auth::user()->user_grp == 'all')
                                        <option value="supp">SUPPLIER</option>
                                        @endif
                                        @if (Auth::user()->user_grp == 'cust' || Auth::user()->user_grp == 'all')
                                        <option value="cust">CUSTOMER</option>
                                        @endif
                                        @if (Auth::user()->user_grp == 'all')
                                        <option value="admin">ALL</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')

@endsection