@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default adverts">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <article>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if (strlen($advert->image_1) > 0)
                                            <a href="{{Storage::disk('adverts')->url($advert->image_1)}}" data-lightbox="image-set-{{$advert->id}}">
                                                <img class="img-fluid" data-lightbox="image-set-{{$advert->id}}"src="{{Storage::disk('adverts')->url($advert->image_1)}}" />
                                            </a>
                                            @endif
                                        </div>
                                        <div class="col-lg-12">
                                            @if (strlen($advert->company) > 0)
                                            <h4>{{$advert->company}}</h4>
                                            @else
                                            <h4>{{$advert->first_name}} {{$advert->last_name}}</h4>
                                            @endif
                                            <p><span class="label">@lang('locations.address'): </span>{{$advert->city->name}}, {{$advert->zip}} {{$advert->city->name}}, {{$advert->country->translate()->name}}</p>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row contact">
                                                <div class="col-lg-4 col-md-12">
                                                    <p><span class="label">@lang('users.phone'): </span>{{$advert->phone}}</p>
                                                </div>       
                                                <div class="col-lg-4 col-md-12">
                                                    <p><span class="label">@lang('users.mobile'): </span>{{$advert->mobile}}</p>
                                                </div>       
                                                <div class="col-lg-4 col-md-12">
                                                    <p><span class="label">@lang('users.website'): </span>{{$advert->website}}</p>
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <p>{{$advert->text}}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            @if (strlen($advert->image_1) > 0)
                                            <a href="{{Storage::disk('adverts')->url($advert->image_1)}}" data-lightbox="image-set-{{$advert->id}}">
                                                <img class="img-fluid" src="{{Storage::disk('adverts')->url($advert->image_1)}}" />
                                            </a>
                                            @endif
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            @if (strlen($advert->image_2) > 0)
                                            <a href="{{Storage::disk('adverts')->url($advert->image_2)}}" data-lightbox="image-set-{{$advert->id}}">
                                                <img class="img-fluid" src="{{Storage::disk('adverts')->url($advert->image_2)}}" />
                                            </a>
                                            @endif
                                        </div>
                                         <div class="col-lg-4 col-md-12">
                                            @if (strlen($advert->image_3) > 0)
                                            <a href="{{Storage::disk('adverts')->url($advert->image_3)}}" data-lightbox="image-set-{{$advert->id}}">
                                                <img class="img-fluid" src="{{Storage::disk('adverts')->url($advert->image_3)}}" />
                                            </a>
                                            @endif
                                        </div>
                                         <div class="col-lg-4 col-md-12">
                                            @if (strlen($advert->image_4) > 0)
                                            <a href="{{Storage::disk('adverts')->url($advert->image_4)}}" data-lightbox="image-set-{{$advert->id}}">
                                                <img class="img-fluid" src="{{Storage::disk('adverts')->url($advert->image_4)}}" />
                                            </a>
                                            @endif
                                        </div>
                                         <div class="col-lg-4 col-md-12">
                                            @if (strlen($advert->image_5) > 0)
                                            <a href="{{Storage::disk('adverts')->url($advert->image_5)}}" data-lightbox="image-set-{{$advert->id}}">
                                                <img class="img-fluid" src="{{Storage::disk('adverts')->url($advert->image_5)}}" />
                                            </a>
                                            @endif
                                        </div>
                                         <div class="col-lg-4 col-md-12">
                                            @if (strlen($advert->image_6) > 0)
                                            <a href="{{Storage::disk('adverts')->url($advert->image_6)}}" data-lightbox="image-set-{{$advert->id}}">
                                                <img class="img-fluid" src="{{Storage::disk('adverts')->url($advert->image_6)}}" />
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
