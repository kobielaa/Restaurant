<div class="filters"> 
    <div class="form-group">
        <div class="input-group ">
            <label for="code">@lang('payments.codes.code')</label>
            <input type="text" class="form-control" name="code" id="code" 
            @if(strlen(app('request')->input('code')) > 0)value="{{app('request')->input('code')}}"@endif>
        </div>
        <div class="input-group ">  
            <label for="multicode">@lang('payments.codes.multicode')</label>              
            <select class="form-control" id="multicode" name="multicode">
                <option value="-1" disabled="true" @if(strlen(app('request')->input('multicode')) == 0)selected="true"@endif>@lang('general.form.select')</option>
                <option value="1" @if(app('request')->input('multicode') == "1")selected="true"@endif>@lang('general.yes')</option>
                <option value="0" @if(app('request')->input('multicode') == "0")selected="true"@endif>@lang('general.no')</option>
            </select>
        </div>
        <div class="input-group ">  
            <label for="enabled">@lang('payments.codes.enabled')</label>              
            <select class="form-control" id="enabled" name="enabled">
                <option value="-1" disabled="true" @if(strlen(app('request')->input('enabled')) == 0)selected="true"@endif>@lang('general.form.select')</option>
                <option value="1" @if(app('request')->input('enabled') == "1")selected="true"@endif>@lang('general.yes')</option>
                <option value="0" @if(app('request')->input('enabled') == "0")selected="true"@endif>@lang('general.no')</option>
            </select>
        </div>
        <div class="input-group ">    
            <label for="type">@lang('users.agents.agent')</label>    
            <select class="form-control" id="agent" name="agent">
                <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                @if(count($agents))
                @foreach ($agents as $row)
                <option value="{{$row->id}}" @if(app('request')->input('agent') == $row->id)selected="true"@endif>
                    {{$row->company}} | {{$row->email}}
                </option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="input-group ">    
            <label for="user">@lang('users.user')</label>    
            <select class="form-control" id="user" name="user">
                <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                @if(count($users))
                @foreach ($users as $row)
                <option value="{{$row->id}}" @if(app('request')->input('user') == $row->id)selected="true"@endif>
                    {{$row->first_name}} {{$row->last_name}} | {{$row->email}}
                </option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="input-group ">  
            <label for="paymentType">@lang('payments.types.type')</label>              
            <select class="form-control" id="paymentType" name="paymentType">
                <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                @if(count($paymentTypes))
                @foreach($paymentTypes as $row)
                    <option value="{{$row->id}}" @if(app('request')->input('paymentType') == $row->id)selected="true"@endif>
                        {{$row->name}}
                    </option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="input-group ">  
            <label for="paymentPeriod">@lang('payments.periods.period')</label>              
            <select class="form-control" id="paymentPeriod" name="paymentPeriod">
                <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                @if(count($paymentPeriods))
                @foreach($paymentPeriods as $row)
                    <option value="{{$row->id}}" @if(app('request')->input('paymentPeriod') == $row->id)selected="true"@endif>
                        {{$row->name}}
                    </option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="input-group ">  
            <label for="country">@lang('locations.countries.country')</label>              
            <select class="form-control countries-list" id="country" name="country">
                <option value="-1" disabled="true" selected="true">@lang('locations.countries.all')</option>
                @if(count($globalData['countries']))
                @foreach($globalData['countries'] as $row)
                    <option value="{{$row->id}}"  @if(app('request')->input('country') == $row->id)selected="true"@endif>
                        {{$row->name}}
                    </option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="input-group">
            <label for="validFrom">@lang('payments.codes.dates.from')</label>
            <input type="text" class="form-control datepicker" data-date-format="dd.mm.yyyy" name="validFrom" 
            placeholder="@lang('auth.placeholder_date')" id="validFrom"
            @if(strlen(app('request')->input('validFrom')) > 0)value="{{app('request')->input('validFrom')}}"@endif>
        </div>
        <div class="input-group">
            <label for="validTo">@lang('payments.codes.dates.to')</label>
            <input type="text" class="form-control datepicker" data-date-format="dd.mm.yyyy" name="validTo" 
            placeholder="@lang('auth.placeholder_date')" id="validTo"
            @if(strlen(app('request')->input('validTo')) > 0)value="{{app('request')->input('validTo')}}"@endif>
        </div>
        <div class="input-group">
            <label for="usageDateFrom">@lang('payments.codes.dates.usage_from')</label>
            <input type="text" class="form-control datepicker" data-date-format="dd.mm.yyyy" name="usageDateFrom" 
            placeholder="@lang('auth.placeholder_date')" id="usageDateFrom"
            @if(strlen(app('request')->input('usageDateFrom')) > 0)value="{{app('request')->input('usageDateFrom')}}"@endif>
        </div>
        <div class="input-group">
            <label for="usageDateTo">@lang('payments.codes.dates.usage_to')</label>
            <input type="text" class="form-control datepicker" data-date-format="dd.mm.yyyy" name="usageDateTo" 
            placeholder="@lang('auth.placeholder_date')" id="usageDateTo"
            @if(strlen(app('request')->input('usageDateTo')) > 0)value="{{app('request')->input('usageDateTo')}}"@endif>
        </div>
        <div class="input-group">
            <button 
                type="button" 
                class="btn btn-block btn-primary filter">@lang('general.form.filters.filter')</button>
        </div>
        <div class="input-group">
            <button 
                type="button" 
                class="btn btn-block btn-primary clear">@lang('general.form.filters.clear')</button>
        </div>
    </div>
</div>