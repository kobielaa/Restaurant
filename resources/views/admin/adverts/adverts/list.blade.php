@extends('layouts.admin')

@section('content')
<div class="title-block">
  <h1 class="title">@lang('adverts.list')</h1>
</div>
<section class="section">
  <div class="row">
    <div class="card">
      <div class="card-block">
        @include('admin.adverts.adverts.filters')
      </div>
    </div>
  </div>
</section>
<section class="section">
  <div class="row">
    <div class="card">
      <div class="card-block">
        <div class="card-title-block">
          <h3><a href="{{route('admin.adverts.adverts.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>@lang('general.form.create_new')</a></h3>
          <div class="clearfix"></div>
        </div>
          <section class="section">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>@lang('general.form.action')</th>
                    <th>@lang('adverts.types.type')</th>
                    <th>@lang('general.form.name')</th>
                    <th>@lang('locations.address')</th>
                    <th>@lang('users.phone')</th>
                    <th>@lang('adverts.dates.validity')</th>
                    <th>@lang('adverts.dates.add')</th>
                    <th>@lang('adverts.show')</th>
                    <th>@lang('adverts.enabled')</th>                                    
                    <th>@lang('general.form.action')</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($adverts))
                  @foreach ($adverts as $row)
                  <tr>
                    <td>
                      <a href="{{ route('admin.adverts.adverts.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs" title="@lang('general.form.edit')">
                          <i class="fa fa-pencil"></i></a>
                      <a href
                          class="btn btn-warning btn-xs toggle-advert-icon"                       
                          data-id="{{$row->id}}" 
                          @if($row->show == 1) data-toggle="false" @elseif($row->show == 0) data-toggle="true" @endif 
                          title="@if($row->show == 1)@lang('adverts.hide')@else @lang('adverts.show') @endif">
                          <i class="fa fa-pencil @if($row->show == 1) fa-eye-slash @else fa-eye @endif"></i></a>
                      <a href="{{ route('admin.adverts.adverts.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs" title="@lang('general.form.delete')">
                          <i class="fa fa-trash-o"></i></a>
                    </td>
                    <td>{{$row->type->name}}</td>
                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                    <td>{{$row->country->name}}, {{$row->city->name}}, {{$row->street}} {{$row->home_no}}</td>
                    <td>{{$row->phone}}</td>
                    <td>{{$row->validity_date}}</td>
                    <td>{{$row->add_date}}</td>
                    <td>@if($row->show == 1) @lang('general.yes') @else @lang('general.no') @endif</td>
                    <td>@if($row->enabled == 1) @lang('general.yes') @else @lang('general.no') @endif</td>
                    <td>
                      <a href="{{ route('admin.adverts.adverts.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs" title="@lang('general.form.edit')">
                          <i class="fa fa-pencil"></i></a>
                      <a href="{{ route('admin.adverts.adverts.edit', ['id' => $row->id]) }}" 
                          class="btn btn-warning btn-xs" title="@if($row->show == 1) @lang('adverts.hide') @else @lang('adverts.show') @endif">
                          <i class="fa fa-pencil @if($row->show == 1) fa-eye-slash @else fa-eye @endif"></i></a>
                      <a href="{{ route('admin.adverts.adverts.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs" title="@lang('general.form.delete')">
                          <i class="fa fa-trash-o"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </section>
      </div>
    </div>
  </div>
</section>
@stop