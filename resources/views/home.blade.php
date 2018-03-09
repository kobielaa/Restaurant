@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default adverts">
                <div class="panel-heading">
                    <h2>@lang('adverts.adverts')</h2>
                </div>
                <div class="panel-body">
                    @if(count($adverts))
                    @foreach($adverts as $advert)
                    <article>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <a href="{{Storage::disk('adverts')->url($advert->image_1)}}" data-lightbox="image-set-{{$advert->id}}">
                                        <img class="img-fluid" src="{{Storage::disk('adverts')->url($advert->image_1)}}" />
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <h4>
                                    @if(isset($baseUrl) && strlen($baseUrl) > 0)
                                        <a href="{{url($baseUrl.$advert->slug)}}">
                                            @if (strlen($advert->company) > 0){{$advert->company}}@else{{$advert->first_name}} {{$advert->last_name}}@endif
                                        </a>
                                    @else
                                        {{--  <a href="{{route('adverts.show', ['id' => $advert->id])}}">{{$advert->company}}</a>  --}}
                                        <a href="{{url('restaurants/'.$advert->country->slug.'/'.$advert->city->slug.'/'.$advert->slug)}}">
                                            @if (strlen($advert->company) > 0){{$advert->company}}@else{{$advert->first_name}} {{$advert->last_name}}@endif
                                        </a>
                                    @endif
                                    </h4>
                                    <p>{{$advert->street}}</p>
                                    <p>{{$advert->city->name}}, {{$advert->zip}} {{$advert->city->name}}, {{$advert->country->translate()->name}}</p>
                                    <p>{{$advert->text}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <dl>
                                        <dt>@lang('cusines.type'):</dt>
                                        <dd>{{$advert->cusine->translate()->name}}</dd>
                                    </dl>
                                </div>    
                                <div class="col-lg-4 col-md-12">
                                    <dl>
                                        <dt>@lang('users.phone'):</dt>
                                        <dd>{{$advert->phone}}</dd>
                                    </dl>
                                    <dl>
                                        <dt>@lang('users.fax'):</dt>
                                        <dd>{{$advert->fax}}</dd>
                                    </dl>
                                    <dl>
                                        <dt>@lang('users.website'):</dt>
                                        <dd><a href="{{$advert->website}}" target="_blank">{{$advert->website}}</a></dd>
                                    </dl>
                                    <dl>
                                        <dt>@lang('users.email'):</dt>
                                        <dd><a href="mailto:{{$advert->email}}">{{$advert->email}}</a></dd>
                                    </dl>
                                </div>    
                            </div>
                        </div>
                        <div class="row row-btn">
                            <div class="col-lg-12 d-flex justify-content-end">
                                @if(isset($baseUrl) && strlen($baseUrl) > 0)
                                <a href="{{url($baseUrl.$advert->slug)}}" class="btn btn-block btn-primary">@lang('general.see_more')</a>
                                @else
                                {{--  <a href="{{route('adverts.show', ['id' => $advert->id])}}" class="btn btn-block btn-primary">@lang('general.see_more')</a>  --}}
                                <a href="{{url('restaurants/'.$advert->country->slug.'/'.$advert->city->slug.'/'.$advert->slug)}}" class="btn btn-block btn-primary">@lang('general.see_more')</a>
                                @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                    {{ $adverts->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
