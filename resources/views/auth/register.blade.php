@extends('layouts.index')

@section('content')
<div class="tab-pane active" id="register">
    <h3>Register Now !!!</h3>
    <h5 class="text-muted">Provide your account information to sign up</h5>
    
    <form id="registration_form" name="registration_form"  class="form-inline" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="row">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-xs-12">
                <label for="name" class="sr-only">Name</label>

                <input id="name" type="text" class="form-control input-group-lg" name="name" value="{{ old('name') }}" title="Enter full name" placeholder="Full name" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} col-xs-12">
                <label for="name" class="sr-only">Username</label>

                <input id="username" type="text" class="form-control input-group-lg" name="username" value="{{ old('username') }}" title="Enter username" placeholder="Username" required>

                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-xs-12">
                <label for="email" class="sr-only">E-Mail Address</label>

                <input id="email" type="email" class="form-control input-group-lg" name="email" value="{{ old('email') }}" title="Enter Email" placeholder="Your Email" required>
                
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

                <input id="password" type="password" class="form-control input-group-lg" name="password" title="Enter password" placeholder="Password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-xs-12">
                <label for="password-confirm" class="sr-only">Confirm Password</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirm password" required>
            </div> 
        </div>
        <a href="#">Already have an account?</a>
        <button type="submit" class="btn btn-primary">
            Sign up
        </button>
    </form>
</div>
@endsection