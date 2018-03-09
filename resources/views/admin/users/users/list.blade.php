@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title"> Users list </h1>
</div>
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-block">
                @include('admin.users.users.filters')
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-block">
                <div class="card-title-block">
                    <h3><a href="{{route('admin.users.users.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Create New </a></h3>
                    <div class="clearfix"></div>
                </div>
                <section class="section">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('general.form.action')</th>
                                    <th>@lang('users.first_name')</th>
                                    <th>@lang('users.last_name')</th>
                                    <th>@lang('users.company')</th>
                                    <th>@lang('users.email')</th>
                                    <th>@lang('locations.countries.country')</th>
                                    <th>@lang('locations.cities.city')</th>
                                    <th>@lang('users.types.type')</th>
                                    <th>@lang('users.dates.validity')</th>
                                    <th>@lang('general.form.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($users))
                                @foreach ($users as $row)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.users.users.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('admin.users.users.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    </td>
                                    <td>{{ isset($row->first_name) ? $row->first_name : '' }}</td>
                                    <td>{{$row->last_name}}</td>
                                    <td>{{$row->company}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{isset($row->country) ? $row->country->name : ''}}</td>
                                    <td>{{isset($row->city) ? $row->city->name : ''}}</td>
                                    <td>{{$row->type->name}}</td>
                                    <td>{{$row->validity_date}}</td>
                                    <td>
                                        <a href="{{ route('admin.users.users.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('admin.users.users.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{$users->links()}}
                </section>
            </div>
        </div>
    </div>
</section>
@stop