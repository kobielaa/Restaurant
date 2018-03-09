@extends('layouts.app')

@section('content')
<div class="advert-content">
    <h1>@lang('adverts.create')</h1>
    <form id="edit-ad-form" class="advert-form" method="post" action="{{route('user.adverts.update', ['id' => $advert->id])}}" enctype="multipart/form-data">
    {{csrf_field()}}
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
                        <option value="{{$row->id}}" @if($advert->advert_type_id == $row->id) selected="true" @endif>{{$row->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('advert_type'))
                    <span class="invalid-feedback">
                        <strong>{{$errors->first('advert_type')}}</strong>
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
                    @include('users.adverts.edit.contact-info')
                </div>
            </div>
            <div class="address-info">    
                <div class="row">
                    <div class="col-lg-12">
                        <h4>@lang('auth.register.address_info'):</h4>
                    </div>
                </div>
                <div class="row">
                    @include('users.adverts.edit.address-info')
                </div>
            </div>
            <div class="ad-info">    
                <div class="row">
                    <div class="col-lg-12">
                        <h4>@lang('adverts.ad_info'):</h4>
                    </div>
                </div>
                <div class="row">
                    @include('users.adverts.edit.ad-info')
                </div>
            </div>
            <div class="img-info">    
                <div class="row">
                    <div class="col-lg-12">
                        <h4>@lang('adverts.img_info'):</h4>
                    </div>
                </div>
                <div class="row">
                    @include('users.adverts.edit.img-info')
                </div>
            </div>
            <div class="row submit">
                <div class="col-lg-12 d-flex justify-content-end">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input name="_method" type="hidden" value="PUT">
                    <button formnovalidate="formnovalidate" type="submit" class="btn btn-block btn-primary">@lang('adverts.update')</button>
                </div>
            </div> 
        </div>
    </form>
</div>
@endsection
