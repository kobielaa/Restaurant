@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title"> Edit permission </h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"><a href="{{route('permissions.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h3>
                </div>
                <form role="form" method="post" action="{{ route('permissions.update', ['id' => $permission->id]) }}">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="control-label" for="name"> Machine name <span class="required">*</span>
                        </label>
                        <input type="text" value="{{$permission->name}}" id="name" name="name" class="form-control underlined">
                        @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
                        <label class="control-label" for="last_name"> Display name <span class="required">*</span>
                        </label>
                        <input type="text" value="{{$permission->display_name}}" id="display_name" name="display_name" class="form-control underlined">
                        @if ($errors->has('display_name'))
                        <span class="help-block">{{ $errors->first('display_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label class="control-label" for="description"> Description <span class="required">*</span>
                        </label>
                        <input type="text" value="{{$permission->description}}" id="description" name="description" class="form-control underlined">
                        @if ($errors->has('description'))
                        <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input name="_method" type="hidden" value="PUT">
                        <button type="submit" class="btn btn-primary">Save permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop