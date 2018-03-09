<div class="col-lg-6 col-md-12">
  <div class="form-group{{$errors->has('country') ? ' is-invalid' : ''}}">
    <label class="control-label" for="country">@lang('locations.countries.country')<span class="required">*</span>
    </label>
    <select class="form-control countries-list select2" id="country" name="country">
      <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
      @if(count($countries))
      @foreach($countries as $row)
      <option value="{{$row->id}}" @if($row->id == $user->country_id) selected="true" @endif>{{$row->name}}</option>
      @endforeach
      @endif
    </select>
    @if ($errors->has('country'))
    <span class="invalid-feedback"><strong>{{$errors->first('country')}}</strong></span>
    @endif
  </div>  
  <div class="form-group{{$errors->has('city') ? ' is-invalid' : ''}}">
    <label class="control-label" for="city">@lang('locations.cities.city')<span class="required">*</span>
    </label>
    <select class="form-control cities-list select2" id="city" name="city">
      <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
      @if(count($cities))
      @foreach($cities as $row)
      <option value="{{$row->id}}" @if($row->id == $user->city_id) selected="true" @endif>{{$row->name}}</option>
      @endforeach
      @endif
    </select>
    @if ($errors->has('city'))
    <span class="invalid-feedback"><strong>{{$errors->first('city')}}</strong></span>
    @endif
  </div>  
  <div class="form-group">
    <div class="input-group @if ($errors->has('other_city')) is-invalid @endif">
      <label for="other_city">@lang('locations.cities.other'):</label>
      <input type="text" class="form-control" name="other_city" value="{{$user->other_city}}" id="other_city">
      <span class="input-group-addon"><i class="fa fa-paper-plane-o"></i></span>
    </div>
    @if ($errors->has('other_city'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('other_city')}}</strong>
    </span>
    @endif
  </div>
</div>
<div class="col-lg-6 col-md-12">
  <div class="form-group">
    <div class="input-group @if ($errors->has('zip')) is-invalid @endif">
      <label for="zip">@lang('locations.zip'):</label>
      <input type="text" class="form-control" name="zip" value="{{$user->zip}}" id="zip">
      <span class="input-group-addon"><i class="fa fa-exclamation-circle"></i></span>
    </div>
    @if ($errors->has('zip'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('zip')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <div class="input-group @if ($errors->has('street')) is-invalid @endif">
      <label for="street">@lang('locations.street'):</label>
      <input type="text" class="form-control" name="street" value="{{$user->street}}" id="street">
      <span class="input-group-addon"><i class="fa fa-road"></i></span>
    </div>
    @if ($errors->has('street'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('street')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <div class="input-group @if ($errors->has('home_number')) is-invalid @endif">
      <label for="home_number">@lang('locations.building'):</label>
      <input type="text" class="form-control" name="home_number" value="{{$user->home_no}}" id="home_number">
      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
    </div>
    @if ($errors->has('home_number'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('home_number')}}</strong>
    </span>
    @endif
  </div>
</div>