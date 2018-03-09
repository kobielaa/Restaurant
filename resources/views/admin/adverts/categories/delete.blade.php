@extends('layouts.admin')

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>@lang('general.form.delete_confirm') <a href="{{route('admin.adverts.categories.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i>@lang('general.nav.back')</a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>@lang('general.form.delete_question') <strong>{{$advertCategory->name}}</strong></p>
                    <form method="POST" action="{{ route('admin.adverts.categories.destroy', ['id' => $advertCategory->id]) }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">@lang('general.form.delete')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop