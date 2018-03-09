@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('adverts.create')</h1>
</div>
<section class="section advert-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"><a href="{{route('admin.adverts.adverts.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i>@lang('general.nav.back')</a></h3>
                </div>
                <form id="add-ad-form" class="advert-form" method="POST" action="{{route('admin.adverts.adverts.store')}}" enctype="multipart/form-data" class="add-ad-form">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>@lang('adverts.types.type'):</h4>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group @if ($errors->has('advert_type')) is-invalid @endif">
                                <label for="advert_type">@lang('adverts.types.type'):</label>
                                <select class="form-control" id="advert_type" name="advert_type" required="required">
                                    <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                                    @if(count($advertTypes))
                                    @foreach($advertTypes as $row)
                                    <option value="{{$row->id}}" @if(old('advert_type')== $row->id) selected="true" @endif>{{$row->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('advert_type'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('advert_type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group @if ($errors->has('user')) is-invalid @endif">
                                <label for="user">@lang('users.user'):</label>
                                <select class="form-control select2" id="user" name="user" required="required">
                                    <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                                    @if(count($users))
                                    @foreach($users as $row)
                                    <option value="{{$row->id}}" @if(old('user')== $row->id) selected="true" @endif>{{$row->email}} | {{$row->first_name}} {{$row->last_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('user'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('user') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="advert-details @if ($errors->any()) validated @endif">
                        <div class="contact-info">    
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>@lang('auth.register.contact_info'):</h4>
                                </div>
                            </div>
                            <div class="row">
                                @include('admin.adverts.adverts.create.contact-info')
                            </div>
                        </div>
                        <div class="address-info">    
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>@lang('auth.register.address_info'):</h4>
                                </div>
                            </div>
                            <div class="row">
                                @include('admin.adverts.adverts.create.address-info')
                            </div>
                        </div>
                        <div class="ad-info">    
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>@lang('adverts.ad_info'):</h4>
                                </div>
                            </div>
                            <div class="row">
                                @include('admin.adverts.adverts.create.ad-info')
                            </div>
                        </div>
                        <div class="img-info">    
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>@lang('adverts.img_info'):</h4>
                                </div>
                            </div>
                            <div class="row">
                                @include('admin.adverts.adverts.create.img-info')
                            </div>
                        </div>
                        <div class="row submit">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button formnovalidate="formnovalidate" type="submit" class="btn btn-block btn-primary">@lang('adverts.create')</button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
