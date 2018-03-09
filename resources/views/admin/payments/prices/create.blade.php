@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('payments.prices.create')</h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-block">
                <div class="title-block">
                    <h3 class="title"><a href="{{route('admin.payments.prices.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i>@lang('general.nav.back')</a></h3>
                </div>
                <form role="form" method="post" action="{{ route('admin.payments.prices.store') }}">
                    {{ csrf_field() }}
                    <div class="input-group @if ($errors->has('price')) is-invalid @endif">
                        <label for="price">@lang('payments.prices.price'):</label>
                        <input type="text" class="form-control" name="price" value="{{ old('price') }}" id="price">
                        <span class="input-group-addon"><i class="fa fa-eur"></i></span>
                    </div>
                    @if ($errors->has('price'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                    @endif
                    <div class="form-group{{ $errors->has('payment_type') ? ' has-error' : '' }}">
                        <label class="control-label" for="payment_type">@lang('payments.types.type'):</label>
                        <select class="form-control" id="payment_type" name="payment_type">
                            <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                            @if(count($paymentTypes))
                            @foreach($paymentTypes as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @if ($errors->has('payment_type'))
                        <span class="help-block">{{ $errors->first('payment_type') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('payment_period') ? ' has-error' : '' }}">
                        <label class="control-label" for="payment_period">@lang('payments.periods.period'):</label>
                        <select class="form-control" id="payment_period" name="payment_period">
                            <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                            @if(count($paymentPeriods))
                            @foreach($paymentPeriods as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @if ($errors->has('payment_period'))
                        <span class="help-block">{{ $errors->first('payment_period') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <button type="submit" class="btn btn-primary">
                        <i class="fa fa-floppy-o"></i>@lang('general.form.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop