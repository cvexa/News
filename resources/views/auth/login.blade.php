@extends('layouts.app')

@section('content')
<div class="col-md-12 text-center header-title">
	<h1>News Task Log in</h1>
</div>

<div class="col-md-4"></div>
<div class="col-md-4 text-center form-holder">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 form-field">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        	</div>
                		</div>

                		<div class="form-group row">
                            <label for="password" class="col-md-4 form-field">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                        </button>
                    </form>
                    <div class="col-md-12 text-right">
                     <a href="{{route('register')}}" class="register-btn">{{ __('Register') }}</a>
                    </div>
</div>
<div class="col-md-4"></div>

@endsection