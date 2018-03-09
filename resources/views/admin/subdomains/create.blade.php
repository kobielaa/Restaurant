@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('subdomains.create')</h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"><a href="{{route('subdomains.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i>@lang('general.nav.back')</a></h3>
                </div>
                <form role="form" method="post" action="{{ route('subdomains.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group @if ($errors->has('user')) is-invalid @endif">
                        <label for="user">@lang('users.user'):</label>
                        <select class="form-control" id="user" name="user" required="required">
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
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="control-label" for="name">@lang('subdomains.name')<span class="required">*</span>
                        </label>
                        <input type="text" value="{{old('name')}}" id="name" name="name" class="form-control underlined">
                        @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
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