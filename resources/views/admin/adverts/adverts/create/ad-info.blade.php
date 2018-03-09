<div class="col-lg-6 col-md-12">
    <div class="form-group @if ($errors->has('payment_period')) is-invalid @endif">
        <label for="payment_period">@lang('payments.periods.period'):</label>
        <select class="form-control" id="payment_period" name="payment_period">
            <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
            @if(count($paymentPeriods))
            @foreach($paymentPeriods as $row)
            <option value="{{$row->id}}" @if($row->id == old('payment_period')) selected="true" @endif>{{$row->name}}</option>
            @endforeach
            @endif
        </select>
        @if ($errors->has('payment_period'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('payment_period') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group @if ($errors->has('cusine')) is-invalid @endif">
        <label for="cusine">@lang('cusines.cusine'):</label>
        <select class="form-control select2" id="cusine" name="cusine">
            <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
            @if(count($cusines))
            @foreach($cusines as $row)
            <option value="{{$row->id}}" @if($row->id == old('cusine')) selected="true" @endif>{{$row->name}}</option>
            @endforeach
            @endif
        </select>
        @if ($errors->has('cusine'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('cusine') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group advert-category @if ($errors->has('advert_category')) is-invalid @endif">
        <label for="advert_category">@lang('adverts.categories.category'):</label>
        <select class="form-control" id="advert_category" name="advert_category">
            <option value="" selected="true">@lang('general.form.select')</option>
            @if(count($advertCategories))
            @foreach($advertCategories as $row)
            <option value="{{$row->id}}" @if($row->id == old('advert_category')) selected="true" @endif>{{$row->name}}</option>
            @endforeach
            @endif
        </select>
        @if ($errors->has('advert_category'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('advert_category') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group wifi @if ($errors->has('wifi')) is-invalid @endif">
        <label for="wifi">@lang('adverts.wifi'):</label>
        <select class="form-control" id="wifi" name="wifi">
            <option value="" selected="true">@lang('general.form.select')</option>
            <option value="no" @if('no' == old('wifi')) selected="true" @endif>@lang('general.no')</option>
            <option value="yes" @if('yes' == old('wifi')) selected="true" @endif>@lang('general.yes')</option>
        </select>
        @if ($errors->has('wifi'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('wifi') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group smoking @if ($errors->has('smoking')) is-invalid @endif">
        <label for="smoking">@lang('adverts.smoking.smoking'):</label>
        <select class="form-control" id="smoking" name="smoking">
            <option value="" selected="true">@lang('general.form.select')</option>
            <option value="no" @if('no' == old('smoking')) selected="true" @endif>@lang('adverts.smoking.no')</option>
            <option value="yes" @if('yes' == old('smoking')) selected="true" @endif>@lang('adverts.smoking.yes')</option>
            <option value="mix" @if('mix' == old('smoking')) selected="true" @endif>@lang('adverts.smoking.mix')</option>
        </select>
        @if ($errors->has('smoking'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('smoking') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group discount">
        <div class="input-group @if ($errors->has('discount')) is-invalid @endif">
            <label for="discount">@lang('adverts.discount'):</label>
            <input type="text" class="form-control" name="discount" value="{{ old('discount') }}" id="discount">
            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
        </div>
        @if ($errors->has('discount'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('discount') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="col-lg-6 col-md-12">
    <div class="form-group @if ($errors->has('advert_text')) is-invalid @endif">
        <label for="advert_text">@lang('adverts.ad_text'):</label>
        <textarea class="form-control" id="advert_text" name="advert_text" rows="4"></textarea>
        @if ($errors->has('advert_text'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('advert_text') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group advert-promo">
        <label for="advert_promo">@lang('adverts.ad_promo'):</label>
        <textarea class="form-control" id="advert_promo" name="advert_promo" rows="4"></textarea>
    </div>
</div>