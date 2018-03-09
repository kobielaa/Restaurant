@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title"> Permissions list </h1>
</div>
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-block">
                <div class="card-title-block">
                    <h3><a href="{{route('admin.users.permissions.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Create New </a></h3>
                    <div class="clearfix"></div>
                </div>
                <section class="section">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Machine name</th>
                                    <th>Display name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($permissions))
                                @foreach ($permissions as $row)
                                <tr>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->display_name}}</td>
                                    <td>{{$row->description}}</td>
                                    <td>
                                        <a href="{{ route('admin.users.permissions.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('admin.users.permissions.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
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