<div class="col-lg-6 col-md-12">
  <div class="form-group">
    <div class="input-group @if ($errors->has('phone')) is-invalid @endif">
      <label for="phone">@lang('users.phone'):</label>
      <input type="text" class="form-control" name="phone" value="{{old('phone')}}" id="phone">
      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
    </div>
    @if ($errors->has('phone'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('phone')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <div class="input-group @if ($errors->has('mobile')) is-invalid @endif">
      <label for="mobile">@lang('users.mobile'):</label>
      <input type="text" class="form-control" name="mobile" value="{{old('mobile')}}" id="mobile">
      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
    </div>
    @if ($errors->has('mobile'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('mobile')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <div class="input-group @if ($errors->has('fax')) is-invalid @endif">
      <label for="fax">@lang('users.fax'):</label>
      <input type="text" class="form-control" name="fax" value="{{old('fax')}}" id="fax">
      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
    </div>
    @if ($errors->has('fax'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('fax')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <div class="input-group @if ($errors->has('website')) is-invalid @endif">
      <label for="website">@lang('users.website'):</label>
      <input type="url" class="form-control" name="website" value="{{old('website')}}" id="website" required="">
      <span class="input-group-addon"><i class="fa fa-external-link"></i></span>
    </div>
    @if ($errors->has('website'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('website')}}</strong>
    </span>
    @endif
  </div>
</div>
<div class="col-lg-6 col-md-12">
  <div class="form-group">
    <div class="input-group company agent @if ($errors->has('company')) is-invalid @endif">
      <label for="company">@lang('users.company'):</label>
      <input type="text" class="form-control" name="company" value="{{old('company')}}" id="company" required="">
      <span class="input-group-addon"><i class="fa fa-exclamation-circle"></i></span>
    </div>
    @if ($errors->has('company'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('company')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <div class="input-group company @if ($errors->has('nip')) is-invalid @endif">
      <label for="nip">@lang('users.nip'):</label>
      <input type="text" class="form-control" name="nip" value="{{old('nip')}}" id="nip" required="">
      <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
    </div>
    @if ($errors->has('nip'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('nip')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group company @if ($errors->has('specialization')) is-invalid @endif">
      <label for="language">@lang('users.specializations.specialization'):</label>
      <select class="form-control" id="specialization" name="specialization">
        <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
        @if(count($specializations))
        @foreach($specializations as $row)
        <option value="{{$row->id}}">{{$row->name}}</option>
        @endforeach
        @endif
      </select>
      @if ($errors->has('specialization'))
      <span class="invalid-feedback">
        <strong>{{$errors->first('specialization')}}</strong>
      </span>
      @endif
  </div>
  <div class="form-group cusine @if ($errors->has('cusine')) is-invalid @endif">
    <label for="language">@lang('cusines.cusine'):</label>
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
      <strong>{{$errors->first('cusine')}}</strong>
    </span>
    @endif
  </div>
</div>