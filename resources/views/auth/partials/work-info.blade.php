<div class="col-lg-6 col-md-12">
    <div class="form-group">
        <label for="job_address">@lang('auth.register.address'):</label>
        <textarea class="form-control" id="job_address" name="job_address" rows="4"></textarea>
    </div>
</div>
<div class="col-lg-6 col-md-12">
    <div class="form-group job @if ($errors->has('job')) is-invalid @endif">
        <label for="job">@lang('users.jobs.job'):</label>
        <select class="form-control" id="job" name="job">
            <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
            @if(count($jobs))
            @foreach($jobs as $row)
            <option value="{{$row->id}}" @if($row->id == 1) selected="true" @endif>{{$row->name}}</option>
            @endforeach
            @endif
        </select>
        @if ($errors->has('job'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('job') }}</strong>
        </span>
        @endif
    </div>
</div>