@extends('layouts.app')

@section('content')
<div class="auth-content">
    <h1>@lang('auth.register.registration')</h1>
    <p>@lang('auth.register.preambule')</p>
    <form id="signup-form" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-12">
                <h4>@lang('auth.register.account_type'):</h4>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="form-group @if ($errors->has('user_type')) is-invalid @endif">
                    <label for="user_type">@lang('users.types.type'):</label>
                    <select class="form-control" id="user_type" name="user_type" required="required">
                        <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                        @if(count($userTypes))
                        @foreach($userTypes as $row)
                        <option value="{{$row->id}}" @if(old('user_type')== $row->id) selected="true" @endif>{{$row->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('user_type'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('user_type') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="account-details @if ($errors->any()) validated @endif">
            <div class="reg-info">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>@lang('auth.register.reg_info'):</h4>
                    </div>
                </div>
                <div class="row">
                    @include('auth.partials.reg-info')
                </div>
            </div>
            <div class="work-info">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>@lang('auth.register.work_info'):</h4>
                    </div>
                </div>
                <div class="row">
                    @include('auth.partials.work-info')
                </div>
            </div>
            <div class="contact-info">    
                <div class="row">
                    <div class="col-lg-12">
                        <h4>@lang('auth.register.contact_info'):</h4>
                    </div>
                </div>
                <div class="row">
                    @include('auth.partials.contact-info')
                </div>
            </div>
            <div class="address-info">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>@lang('auth.register.address_info'):</h4>
                    </div>
                </div>
                <div class="row">
                    @include('auth.partials.address-info')
                </div>
            <div class="spec-info">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>@lang('auth.register.spec_info'):</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="agreement">
                        @lang('auth.register.agreement')
                    </label>
                </div>
            </div>
            <div class="row submit">
                <div class="col-lg-12 d-flex justify-content-end">
                    <button formnovalidate="formnovalidate" type="submit" class="btn btn-block btn-primary">@lang('auth.register.register')</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
