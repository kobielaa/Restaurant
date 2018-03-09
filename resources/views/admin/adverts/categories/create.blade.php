@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('adverts.categories.create')</h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"><a href="{{route('admin.adverts.categories.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i>@lang('general.nav.back')</a></h3>
                </div>
                <form role="form" method="post" action="{{ route('admin.adverts.categories.store') }}">
                    {{ csrf_field() }}
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