<div class="col-lg-6 col-md-12">
  <div class="form-group">
    <div class="input-group @if ($errors->has('email')) is-invalid @endif">
      <label for="email">@lang('users.email'):</label>
      <input type="email" class="form-control" name="email" value="{{old('email')}}" id="email" required="">
      <span class="input-group-addon"><i class="fa fa-paper-plane-o"></i></span>
    </div>
    @if ($errors->has('email'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('email')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <div class="input-group @if ($errors->has('password')) is-invalid @endif">
      <label for="password">@lang('users.password'):</label>
      <input type="password" class="form-control" name="password" id="password" required="">
      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
    </div>
    @if ($errors->has('password'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('password')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <div class="input-group @if ($errors->has('password_confirmation')) is-invalid @endif">
      <label for="password_confirmation">@lang('users.password'):</label>
      <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required="">
      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
    </div>
    @if ($errors->has('password_confirmation'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('password_confirmation')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group @if ($errors->has('gender')) is-invalid @endif">
    <label for="gender">@lang('users.genders.gender'):</label>
    <select class="form-control" id="gender" name="gender">
      <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
      @if(count($genders))
      @foreach($genders as $row)
      <option value="{{$row->id}}" @if(old('gender')== $row->id) selected="true" @endif>{{$row->name}}</option>
      @endforeach
      @endif
    </select>
    @if ($errors->has('gender'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('gender')}}</strong>
    </span>
    @endif
  </div>
</div>
<div class="col-lg-6 col-md-12">
  <div class="form-group">
    <div class="input-group @if ($errors->has('first_name')) is-invalid @endif">
      <label for="first_name">@lang('users.first_name'):</label>
      <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" id="first_name" required="">
      <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
    </div>
    @if ($errors->has('first_name'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('first_name')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <div class="input-group @if ($errors->has('last_name')) is-invalid @endif">
      <label for="last_name">@lang('users.last_name'):</label>
      <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" id="last_name" required="">
      <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
    </div>
    @if ($errors->has('last_name'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('last_name')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <div class="input-group @if ($errors->has('birth_date')) is-invalid @endif">
      <label for="birth_date">@lang('users.birthdate'):</label>
      <input type="text" class="form-control datepicker" data-date-format="dd.mm.yyyy" name="birth_date" placeholder="@lang('auth.placeholder_date')" value="{{old('birth_date')}}" id="birth_date" required="">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    </div>
    @if ($errors->has('birth_date'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('birth_date')}}</strong>
    </span>
    @endif
  </div>
  <div class="form-group @if ($errors->has('language')) is-invalid @endif">
    <label for="language">@lang('locations.languages.language'):</label>
    <select class="form-control" id="language" name="language">
      <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
      @if(count($languages))
      @foreach($languages as $row)
      <option value="{{$row->id}}" @if(old('language')== $row->id) selected="true" @endif>{{$row->name}}</option>
      @endforeach
      @endif
    </select>
    @if ($errors->has('language'))
    <span class="invalid-feedback">
      <strong>{{$errors->first('language')}}</strong>
    </span>
    @endif
  </div>
</div>