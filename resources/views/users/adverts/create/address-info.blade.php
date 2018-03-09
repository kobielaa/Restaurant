<div class="col-lg-6 col-md-12">
    <div class="form-group{{ $errors->has('country') ? ' is-invalid' : '' }}">
        <label class="control-label" for="country">@lang('locations.countries.country')<span class="required">*</span>
        </label>
        <select class="form-control countries-list select2" data-live-search="true" id="country" name="country">
            <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
            @if(count($countries))
            @foreach($countries as $row)
                <option value="{{$row->id}}" @if(Auth::user()->country_id == $row->id) selected="true" @endif>{{$row->name}}</option>
            @endforeach
            @endif
        </select>
        @if ($errors->has('country'))
        <span class="invalid-feedback"><strong>{{ $errors->first('country') }}</strong></span>
        @endif
    </div>  
    <div class="form-group{{ $errors->has('city') ? ' is-invalid' : '' }}">
        <label class="control-label" for="city">@lang('locations.cities.city')<span class="required">*</span>
        </label>
        <select class="form-control cities-list select2" id="city" name="city">
            <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
            @if(count($cities))
            @foreach($cities as $row)
                <option value="{{$row->id}}" @if(Auth::user()->city_id == $row->id) selected="true" @endif>{{$row->name}}</option>
            @endforeach
            @endif
        </select>
        @if ($errors->has('city'))
        <span class="invalid-feedback"><strong>{{ $errors->first('city') }}</strong></span>
        @endif
    </div>  
</div>
<div class="col-lg-6 col-md-12">
    <div class="form-group">
        <div class="input-group @if ($errors->has('zip')) is-invalid @endif">
            <label for="zip">@lang('locations.zip'):</label>
            <input type="text" class="form-control" name="zip" value="{{ Auth::user()->zip }}" id="zip">
            <span class="input-group-addon"><i class="fa fa-exclamation-circle"></i></span>
        </div>
        @if ($errors->has('zip'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('zip') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <div class="input-group @if ($errors->has('street')) is-invalid @endif">
            <label for="street">@lang('locations.street'):</label>
            <input type="text" class="form-control" name="street" value="{{ Auth::user()->street }}" id="street">
            <span class="input-group-addon"><i class="fa fa-road"></i></span>
        </div>
        @if ($errors->has('street'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('street') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <div class="input-group @if ($errors->has('home_number')) is-invalid @endif">
            <label for="home_number">@lang('locations.building'):</label>
            <input type="text" class="form-control" name="home_number" value="{{ Auth::user()->home_no }}" id="home_number">
            <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
        </div>
        @if ($errors->has('home_number'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('home_number') }}</strong>
        </span>
        @endif
    </div>
</div>