@extends('layouts.admin')

@section('content')
<div class="title-block">
  <h1 class="title"> Edit user </h1>
</div>
<section class="section auth-content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-block">
        <div class="title-block">
          <h3 class="title"><a href="{{route('admin.users.users.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i>@lang('general.nav.back')</a></h3>
        </div>
        <form role="form" method="post" action="{{route('admin.users.users.update', ['id' => $user->id])}}">
        {{csrf_field()}}
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
                  <option value="{{$row->id}}" @if($user->user_type_id == $row->id) selected="true" @endif>{{$row->name}}</option>
                  @endforeach
                  @endif
                </select>
                @if ($errors->has('user_type'))
                <span class="invalid-feedback">
                  <strong>{{$errors->first('user_type')}}</strong>
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
                @include('admin.users.users.edit.reg-info')
              </div>
            </div>
            <div class="work-info">
              <div class="row">
                <div class="col-lg-12">
                  <h4>@lang('auth.register.work_info'):</h4>
                </div>
              </div>
              <div class="row">
                @include('admin.users.users.edit.work-info')
              </div>
            </div>
            <div class="contact-info">    
              <div class="row">
                <div class="col-lg-12">
                  <h4>@lang('auth.register.contact_info'):</h4>
                </div>
              </div>
              <div class="row">
                @include('admin.users.users.edit.contact-info')
              </div>
            </div>
            <div class="address-info">
              <div class="row">
                <div class="col-lg-12">
                  <h4>@lang('auth.register.address_info'):</h4>
                </div>
              </div>
              <div class="row">
                @include('admin.users.users.edit.address-info')
              </div>
            <div class="spec-info">
              <div class="row">
                <div class="col-lg-12">
                  <h4>@lang('auth.register.spec_info'):</h4>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <textarea class="form-control" id="description" name="description" rows="4">{{$user->description}}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row submit">
            <div class="col-lg-12 d-flex justify-content-end">
              <input type="hidden" name="_token" value="{{Session::token()}}">
              <input name="_method" type="hidden" value="PUT">
              <button formnovalidate="formnovalidate" type="submit" class="btn btn-primary">Save User Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@stop