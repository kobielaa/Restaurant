@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title"> Create user </h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"><a href="{{route('users.permissions.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h3>
                </div>
                <form role="form" method="post" action="{{ route('users.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label class="control-label" for="first_name">First name <span class="required">*</span>
                        </label>
                        <input type="text" value="{{ old('first_name') }}" id="first_name" name="first_name" class="form-control underlined">
                        @if ($errors->has('first_name'))
                        <span class="help-block">{{ $errors->first('first_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label class="control-label" for="last_name">Last name <span class="required">*</span>
                        </label>
                        <input type="text" value="{{ old('last_name') }}" id="last_name" name="last_name" class="form-control underlined">
                        @if ($errors->has('last_name'))
                        <span class="help-block">{{ $errors->first('last_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="control-label" for="email">Email <span class="required">*</span>
                        </label>
                        <input type="text" value="{{ old('email') }}" id="email" name="email" class="form-control underlined">
                        @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="password" class="form-control underlined" name="password" id="password" placeholder="Enter password" required="">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control underlined" name="password_confirmation" id="password-confirm" placeholder="Re-type password" required="">
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop