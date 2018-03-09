@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('locations.countries.create')</h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"><a href="{{route('admin.locations.countries.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i>@lang('general.nav.back')</a></h3>
                </div>
                <form role="form" method="post" action="{{ route('admin.locations.countries.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('iso') ? ' has-error' : '' }}">
                        <label class="control-label" for="iso">@lang('locations.countries.iso')
                            <span class="required">*</span>
                        </label>
                        <input type="text" value="{{ old('iso') }}" id="iso" name="iso" class="form-control underlined">
                        @if ($errors->has('iso'))
                        <span class="help-block">{{ $errors->first('iso') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('iso3') ? ' has-error' : '' }}">
                        <label class="control-label" for="iso3">@lang('locations.countries.iso3')
                            <span class="required">*</span>
                        </label>
                        <input type="text" value="{{ old('iso3') }}" id="iso3" name="iso3" class="form-control underlined">
                        @if ($errors->has('iso3'))
                        <span class="help-block">{{ $errors->first('iso3') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('continent') ? ' has-error' : '' }}">
                        <label class="control-label" for="continent">@lang('locations.continents.continent')<span class="required">*</span>
                        </label>
                        <input type="text" value="{{ old('continent') }}" id="continent" name="continent" class="form-control underlined">
                        @if ($errors->has('continent'))
                        <span class="help-block">{{ $errors->first('continent') }}</span>
                        @endif
                    </div>
                    @if(count($locales))
                    @foreach ($locales as $row)
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="control-label" for="name_{{ $row }}">@lang('general.form.name') {{ $row }}
                            <span class="required">*</span>
                        </label>
                        <input type="text" value="{{ old('name_'.$row) }}" id="name_{{ $row }}" name="name_{{ $row }}" class="form-control underlined">
                        @if ($errors->has('name_'.$row))
                        <span class="help-block">{{ $errors->first('name_'.$row) }}</span>
                        @endif
                    </div>
                    @endforeach
                    @endif

                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <button type="submit" class="btn btn-primary">
                        <i class="fa fa-floppy-o"></i>@lang('general.form.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop