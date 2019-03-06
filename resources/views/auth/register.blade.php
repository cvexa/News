@extends('layouts.app')

@section('content')
<div class="col-md-12 text-center header-title">
    <h1>News Task Log in</h1>
</div>

<div class="col-md-4"></div>
<div class="col-md-4 text-center form-holder">
                    <form method="POST" action="{{ route('register') }}" autocomplete="off" id="register-form">
                        @csrf
                        <span class="route-no-show" data-route="{{route('validate.mail')}}"></span>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

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
                                <div class="col-md-12 error-taken">
                                    <i class="fas fa-times-circle"></i>
                                    email allready taken
                                </div>
                                <div class="col-md-12 error-not-valid">
                                    <i class="fas fa-times-circle"></i>
                                    email is not valid
                                </div>
                                <div class="col-md-12 success-email">
                                    <i class="fas fa-check-circle"></i>
                                    email is free
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="off">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <div class="col-md-12 short-password">
                                    <i class="fas fa-times-circle"></i>
                                    password must be atleast 8 characters long
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" id="submit-register">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12 text-right">
                     <a href="{{route('login')}}" class="register-btn">{{ __('Log in') }}</a>
                    </div>
                </div>
            </div>
            <script src="{{asset('/js/register-validation.js')}}">
                
            </script>
@endsection
