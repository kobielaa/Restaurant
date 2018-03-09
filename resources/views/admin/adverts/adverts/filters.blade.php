<div class="filters"> 
    <div class="form-group">
        <div class="input-group ">
            <label for="name">@lang('general.form.name')</label>
            <input type="text" class="form-control" name="name" id="name" 
            @if(strlen(app('request')->input('name')) > 0)value="{{app('request')->input('name')}}"@endif>
        </div>
        <div class="input-group ">    
            <label for="type">@lang('adverts.types.type')</label>    
            <select class="form-control" id="type" name="type">
                <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                @if(count($globalData['advert_types']))
                    @foreach($globalData['advert_types'] as $row)
                        <option value="{{$row->id}}" 
                        @if(strlen(app('request')->input('type')) == $row->id)selected="true"@endif>
                            {{$row->name}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="input-group ">  
            <label for="country">@lang('locations.countries.country')</label>              
            <select class="form-control countries-list select2" id="country" name="country">
                <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                @if(count($globalData['countries']))
                @foreach($globalData['countries'] as $row)
                    <option value="{{$row->id}}" 
                        @if(strlen(app('request')->input('country')) == $row->id)selected="true"@endif>
                            {{$row->name}}
                        </option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="input-group ">    
            <label for="city">@lang('locations.cities.city')</label>              
            <select class="form-control cities-list select2" id="city" name="city">
                <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
            </select>
        </div>
        <div class="input-group ">  
            <label for="cusine">@lang('cusines.cusine')</label>              
            <select class="form-control select2" id="cusine" name="cusine">
                <option value="-1" disabled="true" selected="true">@lang('general.form.select')</option>
                @if(count($globalData['cusines']))
                @foreach($globalData['cusines'] as $row)
                    <option value="{{$row->id}}" 
                        @if(strlen(app('request')->input('cusine')) == $row->id)selected="true"@endif>
                            {{$row->name}}
                        </option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="input-group ">  
            <label for="show">@lang('adverts.show')</label>              
            <select class="form-control" id="show" name="show">
                <option value="-1" disabled="true" @if(strlen(app('request')->input('show')) == 0)selected="true"@endif>@lang('general.form.select')</option>
                <option value="1" @if(app('request')->input('show') == "1")selected="true"@endif>@lang('general.yes')</option>
                <option value="0" @if(app('request')->input('show') == "0")selected="true"@endif>@lang('general.no')</option>
            </select>
        </div>
        <div class="input-group ">  
            <label for="enabled">@lang('adverts.enabled')</label>              
            <select class="form-control" id="enabled" name="enabled">
                <option value="-1" disabled="true" @if(strlen(app('request')->input('enabled')) == 0)selected="true"@endif>@lang('general.form.select')</option>
                <option value="1" @if(app('request')->input('enabled') == "1")selected="true"@endif>@lang('general.yes')</option>
                <option value="0" @if(app('request')->input('enabled') == "0")selected="true"@endif>@lang('general.no')</option>
            </select>
        </div>
        <div class="input-group">
            <label for="from">@lang('users.dates.validity_from')</label>
            <input type="text" class="form-control datepicker" data-date-format="dd.mm.yyyy" name="from" 
            placeholder="@lang('auth.placeholder_date')" id="from"
            @if(strlen(app('request')->input('from')) > 0)value="{{app('request')->input('from')}}"@endif>
        </div>
        <div class="input-group">
            <label for="to">@lang('users.dates.validity_to')</label>
            <input type="text" class="form-control datepicker" data-date-format="dd.mm.yyyy" name="to" 
            placeholder="@lang('auth.placeholder_date')" id="to"
            @if(strlen(app('request')->input('to')) > 0)value="{{app('request')->input('to')}}"@endif>
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