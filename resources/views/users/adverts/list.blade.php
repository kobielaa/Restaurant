@extends('layouts.app')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('adverts.list')</h1>
</div>
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-block">
                <div class="card-title-block">
                    <h3><a href="{{route('user.adverts.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>@lang('general.form.create_new')</a></h3>
                    <div class="clearfix"></div>
                </div>
                <section class="section">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('general.form.action')</th>
                                    <th>@lang('adverts.id')</th>
                                    <th>@lang('adverts.dates.validity')</th>
                                    <th>@lang('adverts.dates.add')</th>
                                    <th>@lang('adverts.types.type')</th>
                                    <th>@lang('payments.statuses.status')</th>
                                    <th>@lang('general.form.action')</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($adverts))
                                @foreach ($adverts as $advert)
                                <tr>
                                    <td>
                                        <a href="{{ route('user.adverts.edit', ['id' => $advert->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('user.adverts.show', ['id' => $advert->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    </td>
                                    <td>{{$advert->id}}</td>
                                    <td>{{$advert->validity_date}}</td>
                                    <td>{{$advert->add_date}}</td>
                                    <td>{{$advert->type->name}}</td>
                                    <td>-</td>
                                    <td>
                                        <a href="{{ route('user.adverts.edit', ['id' => $advert->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('user.adverts.show', ['id' => $advert->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
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