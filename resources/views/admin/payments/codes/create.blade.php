@extends('layouts.admin')

@section('content')
<div class="title-block">
  <h1 class="title">@lang('payments.codes.create')</h1>
</div>
<section class="section">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-block payments">
        <div class="title-block">
          <h3 class="title"><a href="{{route('admin.payments.codes.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i>@lang('general.nav.back')</a></h3>
        </div>
        <form role="form" method="post" action="{{ route('admin.payments.codes.store') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('multicode') ? ' has-error' : '' }}">
            <label for="wifi">@lang('payments.codes.multicode'):</label>
            <select class="form-control" id="multicode" name="multicode">
              <option value="-1" disabled="true" @if(old('multicode') == '') selected="true" @endif>@lang('general.form.select')</option>
              <option value="0" @if(old('multicode') == '0') selected="true" @endif>@lang('general.no')</option>
              <option value="1" @if(old('multicode') == '1') selected="true" @endif>@lang('general.yes')</option>
            </select>
            @if ($errors->has('multicode'))
            <span class="help-block">{{ $errors->first('multicode') }}</span>
            @endif
          </div> 
          <div class="codes @if(old('multicode') > -1) validated @endif">
            <div class="input-group multi{{ $errors->has('code') ? ' has-error' : '' }}">
              <label for="code">@lang('payments.codes.code'):</label>
              <input type="text" class="form-control" name="code" value="{{ old('code') }}" id="code">
              @if ($errors->has('code'))
                <span class="help-block">{{ $errors->first('code') }}</span>
              @endif
            </div>
            <div class="form-group multi{{ $errors->has('country') ? ' has-error' : '' }}">
              <label class="control-label" for="country">@lang('locations.countries.country'):</label>
              <select class="form-control" id="country" name="country">
                <option value="0">@lang('locations.countries.all')</option>
                @if(count($countries))
                @foreach($countries as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
                @endif
              </select>
              @if ($errors->has('country'))
              <span class="help-block">{{ $errors->first('country') }}</span>
              @endif
            </div>
            <div class="form-group multi">
              <div class="input-group{{ $errors->has('from_date') ? ' has-error' : '' }}">
                <label for="from_date">@lang('payments.codes.dates.from'):</label>
                <input type="text" class="form-control datepicker" data-date-format="dd.mm.yyyy" 
                  name="from_date" placeholder="@lang('auth.placeholder_date')" 
                  value="{{ old('from_date') }}" id="from_date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
              @if ($errors->has('from_date'))
                <span class="help-block">{{ $errors->first('from_date') }}</span>
              @endif
            </div>
            <div class="form-group multi">
              <div class="input-group{{ $errors->has('to_date') ? ' has-error' : '' }}">
                <label for="to_date">@lang('payments.codes.dates.to'):</label>
                <input type="text" class="form-control datepicker" data-date-format="dd.mm.yyyy" 
                  name="to_date" placeholder="@lang('auth.placeholder_date')" 
                  value="{{ old('to_date') }}" id="to_date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              </div>
              @if ($errors->has('to_date'))
                <span class="help-block">{{ $errors->first('to_date') }}</span>
              @endif
            </div>
            <div class="form-group multi{{ $errors->has('payment_type') ? ' has-error' : '' }}">
              <label class="control-label" for="payment_type">@lang('payments.types.type'):</label>
              <select class="form-control" id="payment_type" name="payment_type">
                <option value="-1" disabled="true" @if(old('payment_type') == '') selected="true" @endif>@lang('general.form.select')</option>
                @if(count($paymentTypes))
                @foreach($paymentTypes as $row)
                <option value="{{$row->id}}" 
                  @if($row->id == old('payment_type')) selected="true" @endif>{{$row->name}}</option>
                @endforeach
                @endif
              </select>
              @if ($errors->has('payment_type'))
              <span class="help-block">{{ $errors->first('payment_type') }}</span>
              @endif
            </div>
            <div class="form-group multi{{ $errors->has('payment_period') ? ' has-error' : '' }}">
              <label class="control-label" for="payment_period">@lang('payments.periods.period'):</label>
              <select class="form-control" id="payment_period" name="payment_period">
                <option value="-1" disabled="true" @if(old('payment_period') == '') selected="true" @endif>@lang('general.form.select')</option>
                @if(count($paymentPeriods))
                @foreach($paymentPeriods as $row)
                <option value="{{$row->id}}" 
                  @if($row->id == old('payment_period')) selected="true" @endif>{{$row->name}}</option>
                @endforeach
                @endif
              </select>
              @if ($errors->has('payment_period'))
              <span class="help-block">{{ $errors->first('payment_period') }}</span>
              @endif
            </div>
            @if(count($paymentPrices))
            @foreach($paymentPrices as $row)
            <div class="input-group single{{$errors->has('payment_code_'.$row->id) ? ' has-error' : ''}}">
              <label class="control-label" for="payment_code_{{$row->id}}">
                {{$row->type->name}} {{$row->period->name}}
              </label>
              <input type="text" class="form-control" 
                name="payment_code_{{$row->id}}" 
                value="{{old('payment_code_'.$row->id)}}" 
                id="payment_code_{{$row->id}}">
              @if ($errors->has('code'))
              <span class="help-block">{{$errors->first('payment_code_'.$row->id)}}</span>
              @endif
            </div>
            @endforeach
            @endif
            <div class="form-group">
              <input type="hidden" name="_token" value="{{ Session::token() }}">
              <button type="submit" class="btn btn-primary">
              <i class="fa fa-floppy-o"></i>@lang('general.form.save')</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@stop