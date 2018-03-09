@extends('layouts.admin')

@section('content')
<div class="title-block">
    <h1 class="title">@lang('users.types.list')</h1>
</div>
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-block">
                <div class="card-title-block">
                    <h3><a href="{{route('admin.users.types.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>@lang('general.form.create_new')</a></h3>
                    <div class="clearfix"></div>
                </div>
                <section class="section">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('general.form.action')</th>
                                    @if(count($locales))
                                    @foreach ($locales as $row)
                                    <th>@lang('users.types.type') {{ $row }}</th>
                                    @endforeach
                                    @endif
                                    <th>@lang('general.form.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($typesTranslations))
                                @foreach ($typesTranslations as $type)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.users.types.edit', ['id' => $type['element_id']]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('admin.users.types.show', ['id' => $type['element_id']]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    </td>
                                    @if(count($locales))
                                    @foreach ($locales as $locale)
                                    @if(isset($type[$locale]))
                                    <td>{{$type[$locale]['name']}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                    @endforeach
                                    @endif 
                                    <td>
                                        <a href="{{ route('admin.users.types.edit', ['id' => $type['element_id']]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                        <a href="{{ route('admin.users.types.show', ['id' => $type['element_id']]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
@stop