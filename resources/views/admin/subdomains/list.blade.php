@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('subdomains.list')</h1>
</div>
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-block">
                <div class="card-title-block">
                    <h3><a href="{{route('subdomains.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>@lang('general.form.create_new')</a></h3>
                    <div class="clearfix"></div>
                </div>
                <section class="section">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('general.form.action')</th>
                                    <th>@lang('subdomains.name')</th>
                                    <th>@lang('subdomains.url')</th>                                    
                                    <th>@lang('users.email')</th>
                                    <th>@lang('users.first_name')</th>
                                    <th>@lang('users.last_name')</th>
                                    <th>@lang('general.form.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($subdomains))
                                @foreach ($subdomains as $row)
                                <tr>
                                    <td>
                                        <a href="{{ route('subdomains.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('subdomains.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    </td>
                                    <td>{{$row->name}}</td>
                                    <td><a href="http://{{$row->name}}.digitaldudes.cloud" target="_blank">http://{{$row->name}}.digitaldudes.cloud</td>
                                    <td>{{$row->user->email}}</td>
                                    <td>{{$row->user->first_name}}</td>
                                    <td>{{$row->user->last_name}}</td>
                                    <td>
                                        <a href="{{ route('subdomains.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('subdomains.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
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