@extends('layouts.app')

@section('content')
<div class="auth-content">
    @if(Session::has('alert'))
    <div class="alert alert-success">
        {{ Session::get('alert') }}
        @php
        Session::forget('alert');
        @endphp
    </div>
    @endif
    <h1>@lang('auth.login.login')</h1>
    {{--  <p>@lang('auth.register.preambule')</p>  --}}
    <form role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <label for="email">Email</label>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            @if ($errors->has('email'))
            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
            <input type="text" class="form-control underlined" id="email" name="email" 
            placeholder="Your email address" value="{{ old('email') }}" required autofocus/>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password</label>
            @if ($errors->has('password'))
            <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
            @endif
            <input type="password" class="form-control underlined" id="password" 
            name="password" placeholder="Your password"/>
        </div>
        <div class="form-group">
            <label for="remember">
                <input class="checkbox" id="remember" type="checkbox" 
                {{ old('remember') ? 'checked' : '' }}>
                <span>Remember me</span>
            </label>
            <a href="reset.html" class="forgot-btn pull-right">Forgot password?</a>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">Login</button>
        </div>
        <div class="form-group">
            <p class="text-muted text-center">Do not have an account?
                <a href="{{route('register')}}">Sign Up!</a>
            </p>
        </div>
    </form>
</div>
@endsection