@extends('layouts.app')

@section('meta')
    <title> {{$property->name}} </title>
@stop

@section('title')
    <section class="section-full text-left">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{ucfirst($property->name)}}</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{route('welcome')}}">Home</a></li>
                        <li class="active">Immobili in Vendita</li>
                    </ol>
                    @auth
                        @if(auth()->user()->hasRole('super'))
                            <a href="{{route('properties.edit', $property->id)}}" class="btn btn-warning btn-xs">EDIT</a>
                            <a href="{{route('properties.media', $property->id)}}" class="btn btn-warning btn-xs">IMG</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </section>
@stop

@section('content')
    <section class="bg-dark section-sm section-sm-mod-1 text-left">
        <div class="container">
            <div class="row flow-offset-7">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <p>{{__('Contratto')}}</p>
                    <b class="h5 text-sushi text-regular">{{$property->contract->name}}</b>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <p>{{__('Dove')}}</p>
                    <b class="h5 text-sushi text-regular">{{$property->city->comune}}</b>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <p>{{__('Tipologia')}}</p>
                    <b class="h5 text-sushi text-regular">{{$property->tag->name}}</b>
                </div>
                @if($property->show_address)
                    @if($property->address)
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                            <p>{{__('Indirizzo')}}</p>
                            <p class="h5 text-regular">{{$property->address}}</p>
                        </div>
                    @endif
                @endif
                @if($property->show_price)
                    @if(!is_null($property->sell_price) || !is_null($property->rent_price) )
                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2 col-lg-offset-1">
                            <p>{{__('Prezzo')}}</p>
                            @if($property->contract->id == 1)
                                <p class="thumbnail-price h5">€ {{number_format($property->sell_price, 0,',', '.')}}</p>
                            @elseif($property->contract->id == 2)
                                <p class="thumbnail-price h5">€ {{number_format($property->rent_price, 0,',', '.')}}
                                    <span class="mon text-regular">/{{$property->rent_period ? __($property->rent_period) : __('mese')}}</span>
                                </p>
                            @else

                            @endif
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>

    <section class="section-sm section-sm-mod-2 text-left">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8">
                    @if(!$images->isEmpty())
                        @include('properties.show.images')
                    @endif
                    <div class="row">
                        @include('properties.show.attributes')
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    {{-- <div style="width:100%; height:300px; background:red"></div> --}}
                    @if($property->city->comune == "Cortina d'Ampezzo")
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21958.178192726933!2d12.124801567518773!3d46.53240795665743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47783435d247033f%3A0xdd3c30437b92e42b!2s32043%20Cortina%20d&#39;Ampezzo%2C%20Province%20of%20Belluno!5e0!3m2!1sen!2sit!4v1622807877550!5m2!1sen!2sit" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @elseif($property->city->comune == "Borca di Cadore")
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10998.45911130245!2d12.213718846842605!3d46.43651446739072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4779b4fbc3ccf135%3A0xfae47f38eeec5016!2s32040%20Borca%20di%20Cadore%20Province%20of%20Belluno!5e0!3m2!1sen!2sit!4v1623335417705!5m2!1sen!2sit" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @elseif($property->city->comune == "Ciabiana di Cadore")
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5504.212022993897!2d12.282827527917284!3d46.38712241706343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4779b136fc79526b%3A0xd265adb86a25b996!2s32040%20Cibiana%20di%20Cadore%20Province%20of%20Belluno!5e0!3m2!1sen!2sit!4v1623335499109!5m2!1sen!2sit" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @elseif($property->city->comune == "Lozzo di Cadore")
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5494.201133366558!2d12.439508127927919!3d46.48632105361792!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4779c7af44534949%3A0xb1073f9d6ac50a45!2s32040%20Lozzo%20di%20Cadore%2C%20Province%20of%20Belluno!5e0!3m2!1sen!2sit!4v1623335559504!5m2!1sen!2sit" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @elseif($property->city->comune == "Pieve di Cadore")
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11000.425902818499!2d12.367838491920288!3d46.42676910639988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4779b778448de791%3A0x349d8980f887a66d!2s32044%20Pieve%20di%20Cadore%2C%20Province%20of%20Belluno!5e0!3m2!1sen!2sit!4v1623335604275!5m2!1sen!2sit" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @elseif($property->city->comune == "San Vito di Cadore")
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10992.746078372185!2d12.195949091936653!3d46.464813346096484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4779b538a882c99b%3A0x9720416696c33454!2s32046%20San%20Vito%20di%20Cadore%2C%20Province%20of%20Belluno!5e0!3m2!1sen!2sit!4v1623335672540!5m2!1sen!2sit" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @elseif($property->city->comune == "Valle di Cadore")
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5501.162107352839!2d12.32811007792042!3d46.417361562967216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4779b7107047e125%3A0x9c24bbf3a4b4c063!2s32040%20Valle%20di%20Cadore%2C%20Province%20of%20Belluno!5e0!3m2!1sen!2sit!4v1623335777977!5m2!1sen!2sit" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @elseif($property->city->comune == "Vodo Cadore")
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5500.988542017828!2d12.241738327920634!3d46.419081962734126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4779b41551072fc3%3A0x32fba10bfbb4e70e!2s32040%20Vodo%20di%20Cadore%2C%20Province%20of%20Belluno!5e0!3m2!1sen!2sit!4v1623335826775!5m2!1sen!2sit" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    @endif
                    <br><br>
                    <div class="sidebar-module">
                        <h4 class="border-bottom">{{__('Condividi')}}</h4>
                        <div class="icon-group">
                            <a href="#" class="icon icon-sm icon-social" style="background:#395b98"><i class="fab fa-facebook-f"></i></a>
                            {{-- <a href="#" class="icon icon-sm icon-social fa-twitter"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="icon icon-sm icon-social fa-google-plus"><i class="fa fa-facebook"></i></a> --}}
                        </div>
                    </div>
                    <br><br>

                    @include('properties.show.request')


                </div>
            </div>
        </div>
    </section>

    @include('properties.show.related')

    @include('layouts.elements.why-us')
    @include('layouts.elements.warranties')


<div tabindex="-1" role="dialog" aria-hidden="true" class="pswp">
<div class="pswp__bg"></div>
<div class="pswp__scroll-wrap">
<div class="pswp__container">
<div class="pswp__item"></div>
<div class="pswp__item"></div>
<div class="pswp__item"></div>
</div>
<div class="pswp__ui pswp__ui--hidden">
<div class="pswp__top-bar">
<div class="pswp__counter"></div>
<button title="Close (Esc)" class="pswp__button pswp__button--close"></button>
<button title="Share" class="pswp__button pswp__button--share"></button>
<button title="Toggle fullscreen" class="pswp__button pswp__button--fs"></button>
<button title="Zoom in/out" class="pswp__button pswp__button--zoom"></button>
<div class="pswp__preloader">
<div class="pswp__preloader__icn">
<div class="pswp__preloader__cut">
<div class="pswp__preloader__donut"></div>
</div>
</div>
</div>
</div>
<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
<div class="pswp__share-tooltip"></div>
</div>
<button title="Previous (arrow left)" class="pswp__button pswp__button--arrow--left"></button>
<button title="Next (arrow right)" class="pswp__button pswp__button--arrow--right"></button>
<div class="pswp__caption">
<div class="pswp__caption__cent"></div>
</div>
</div>
</div>
</div>

@stop
