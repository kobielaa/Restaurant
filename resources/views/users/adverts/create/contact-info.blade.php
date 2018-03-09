<div class="col-lg-6 col-md-12">
    <div class="form-group">
        <div class="input-group @if ($errors->has('first_name')) is-invalid @endif">
            <label for="first_name">@lang('users.first_name'):</label>
            <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}" id="first_name" required="">
            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
        </div>
        @if ($errors->has('first_name'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('first_name') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <div class="input-group @if ($errors->has('last_name')) is-invalid @endif">
            <label for="last_name">@lang('users.last_name'):</label>
            <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" id="last_name" required="">
            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
        </div>
        @if ($errors->has('last_name'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('last_name') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <div class="input-group @if ($errors->has('company')) is-invalid @endif">
            <label for="company">@lang('users.company'):</label>
            <input type="text" class="form-control" name="company" value="{{ Auth::user()->company }}" id="company" required="">
            <span class="input-group-addon"><i class="fa fa-exclamation-circle"></i></span>
        </div>
        @if ($errors->has('company'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('company') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <div class="input-group @if ($errors->has('email')) is-invalid @endif">
            <label for="email">@lang('users.email'):</label>
            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" id="email" required="">
            <span class="input-group-addon"><i class="fa fa-paper-plane-o"></i></span>
        </div>
        @if ($errors->has('email'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group @if ($errors->has('language')) is-invalid @endif">
        <label for="language">@lang('locations.languages.language'):</label>
        <select class="form-control" id="language" name="language">
            <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
            @if(count($languages))
            @foreach($languages as $row)
            <option value="{{$row->id}}" @if(Auth::user()->language_id == $row->id) selected="true" @endif>{{$row->name}}</option>
            @endforeach
            @endif
        </select>
        @if ($errors->has('language'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('language') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="col-lg-6 col-md-12">
    <div class="form-group">
        <div class="input-group @if ($errors->has('phone')) is-invalid @endif">
            <label for="phone">@lang('users.phone'):</label>
            <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" id="phone">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
        </div>
        @if ($errors->has('phone'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('phone') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <div class="input-group @if ($errors->has('mobile')) is-invalid @endif">
            <label for="mobile">@lang('users.mobile'):</label>
            <input type="text" class="form-control" name="mobile" value="{{ Auth::user()->mobile }}" id="mobile">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
        </div>
        @if ($errors->has('mobile'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('mobile') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <div class="input-group @if ($errors->has('fax')) is-invalid @endif">
            <label for="fax">@lang('users.fax'):</label>
            <input type="text" class="form-control" name="fax" value="{{ Auth::user()->fax }}" id="fax">
            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
        </div>
        @if ($errors->has('fax'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('fax') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group">
        <div class="input-group @if ($errors->has('website')) is-invalid @endif">
            <label for="website">@lang('users.website'):</label>
            <input type="url" class="form-control" name="website" value="{{ Auth::user()->website }}" id="website" required="">
            <span class="input-group-addon"><i class="fa fa-external-link"></i></span>
        </div>
        @if ($errors->has('website'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('website') }}</strong>
        </span>
        @endif
    </div>
</div>