@extends('layouts.index')

@section('content')
<div class="tab-pane active" id="login">
    <h3>Login</h3>
    <h5 class="text-muted">Log into your account</h5>
    
    <!--Login Form-->
    <form name="login_form" id="login_form" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        
        <div class="row">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-xs-12">
                <label for="email" class="sr-only">Email</label>
                <input id="email" type="email" class="form-control input-group-lg" name="email" title="Enter Email" value="{{ old('email') }}" placeholder="Your Email" required autofocus/>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-xs-12">
                <label for="password" class="sr-only">Password</label>
                <input id="password" type="password" class="form-control input-group-lg" name="password" title="Enter password" placeholder="Password" required/>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group col-xs-12">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
        </div>
        <a href="{{ route('password.request') }}">Forgot Your Password?</a>
        <button type="submit" class="btn btn-primary">Log in</button>
    </form>
</div>
@endsection