@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('locations.cities.create')</h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"><a href="{{route('admin.locations.cities.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i>@lang('general.nav.back')</a></h3>
                </div>
                <form role="form" method="post" action="{{route('admin.locations.cities.store')}}">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                        <label class="control-label" for="name">@lang('locations.cities.name')<span class="required">*</span>
                        </label>
                        <input type="text" value="{{old('name')}}" id="name" name="name" class="form-control underlined">
                        @if ($errors->has('name'))
                        <span class="help-block">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('name_clean') ? ' has-error' : ''}}">
                        <label class="control-label" for="name_clean">@lang('locations.cities.name_clean')<span class="required">*</span>
                        </label>
                        <input type="text" value="{{old('name_clean')}}" id="name_clean" name="name_clean" class="form-control underlined">
                        @if ($errors->has('name_clean'))
                        <span class="help-block">{{$errors->first('name_clean')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('country') ? ' has-error' : ''}}">
                        <label class="control-label" for="country">@lang('locations.countries.country')<span class="required">*</span>
                        </label>
                        <select class="form-control" id="country" name="country">
                            @if(count($countries))
                                @foreach($countries as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('country'))
                        <span class="help-block">{{$errors->first('country')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                        <button type="submit" class="btn btn-primary">@lang('locations.cities.create')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop