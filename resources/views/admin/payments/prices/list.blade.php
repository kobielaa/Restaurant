@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('payments.prices.list')</h1>
</div>
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-block">
                <div class="card-title-block">
                    <h3><a href="{{route('admin.payments.prices.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>@lang('general.form.create_new')</a></h3>
                    <div class="clearfix"></div>
                </div>
                <section class="section">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('general.form.action')</th>
                                    <th>@lang('payments.prices.price')</th>
                                    <th>@lang('payments.types.type')</th>
                                    <th>@lang('payments.periods.period')</th>
                                    <th>@lang('general.form.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($prices))
                                @foreach ($prices as $row)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.payments.prices.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('admin.payments.prices.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    </td>
                                    <td>{{$row->price}}</td>
                                    <td>{{$row->type->name}}</td>
                                    <td>{{$row->period->name}}</td>
                                    <td>
                                        <a href="{{ route('admin.payments.prices.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('admin.payments.prices.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
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