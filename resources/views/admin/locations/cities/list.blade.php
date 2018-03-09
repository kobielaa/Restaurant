@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('locations.cities.list')</h1>
</div>
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-block">
                <div class="card-title-block">
                    <h3><a href="{{route('admin.locations.cities.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Create New </a></h3>
                    <div class="clearfix"></div>
                </div>
                <section class="section">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                  <th>@lang('locations.cities.name')</th>
                                  <th>@lang('locations.cities.name_clean')</th>
                                  <th>@lang('locations.countries.country')</th>
                                  <th>@lang('general.form.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($cities))
                                  @foreach ($cities as $row)
                                  <tr>
                                      <td>{{$row->name}}</td>
                                      <td>{{$row->name_clean}}</td>
                                      <td>{{$row->country->name}}</td>
                                      <td>
                                          <a href="{{ route('admin.locations.cities.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                          <a href="{{ route('admin.locations.cities.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                      </td>
                                  </tr>
                                  @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                      {{ $cities->links() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
@stop