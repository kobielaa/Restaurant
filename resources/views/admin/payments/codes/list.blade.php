@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('payments.codes.list')</h1>
</div>
<section class="section">
  <div class="row">
    <div class="card">
      <div class="card-block">
        @include('admin.payments.codes.filters', ['agents' => $agents, 'users' => $users])
      </div>
    </div>
  </div>
</section>
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-block">
                <div class="card-title-block">
                    <h3><a href="{{route('admin.payments.codes.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>@lang('general.form.create_new')</a></h3>
                    <div class="clearfix"></div>
                </div>
                <section class="section">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('general.form.action')</th>
                                    <th>@lang('payments.codes.code')</th>
                                    <th>@lang('payments.codes.enabled')</th>
                                    <th>@lang('payments.codes.multicode')</th>
                                    <th>@lang('users.agents.agent')</th>
                                    <th>@lang('users.user')</th>
                                    <th>@lang('payments.types.type')</th>
                                    <th>@lang('payments.periods.period')</th>
                                    <th>@lang('locations.countries.country')</th>
                                    <th>@lang('payments.codes.dates.from')</th>
                                    <th>@lang('payments.codes.dates.to')</th>
                                    <th>@lang('payments.codes.dates.usage')</th>
                                    <th>@lang('payments.codes.usages')</th>                                    
                                    <th>@lang('general.form.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($paymentCodes))
                                @foreach ($paymentCodes as $row)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.payments.codes.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    </td>
                                    <td>{{$row->code}}</td>
                                    <td>@if($row->enabled == 1) @lang('general.yes') @else @lang('general.no') @endif</td>
                                    <td>@if($row->multicode == 1) @lang('general.yes') @else @lang('general.no') @endif</td>
                                    <td>@if(isset($row->agent)){{$row->agent->email}}@endif</td>
                                    <td>@if(isset($row->user)){{$row->user->email}}@endif</td>
                                    <td>{{$row->type->name}}</td>
                                    <td>{{$row->period->name}}</td>
                                    <td>@if($row->country_id > 0){{$row->country->name}}@else @lang('locations.countries.all') @endif</td>
                                    <td>{{$row->from_date}}</td>
                                    <td>{{$row->to_date}}</td>
                                    <td>{{$row->usage_date}}</td>
                                    <td>{{$row->usages}}</td>
                                    <td>
                                        <a href="{{ route('admin.payments.codes.show', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
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