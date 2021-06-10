@extends('layouts.app')

@section('meta')
    <title>{{__('Contatti')}}</title>
@stop

@section('content')
    <section class="section-full text-left">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('Contatti')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="active">{{__('Contatti')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="section-md text-left">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div id="map-canvas" style="height:350px;width:100%"></div>

                    <p>{{__('Può contattarci visitando i nostri uffici di Cortina d\'Ampezzo o Di San Vito di Cadore. Altrimenti potrete chiamarci negli orari d\'ufficio, altrimenti compilate la form qui sotto e vi ricontatteremo nel arco di 24 ore.')}}</p>
                    <form data-form-type="contact" method="post" action="#" class="rd-mailform text-left offset-11">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">{{__('Nome e Cognome')}}*</label>
                                    <input id="name" type="text" name="name" required class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 input-mod-1">
                                <div class="form-group">
                                    <label for="phone" class="form-label">{{__('Telefono')}}</label>
                                    <input id="phone" type="text" name="phone" required class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="contact-email" class="form-label">{{__('Email')}}*</label>
                                    <input id="contact-email" type="email" name="email" data-constraints="@Required @Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="contact-message" class="form-label">{{__('Richiesta')}}*</label>
                                    <textarea id="contact-message" name="message" data-constraints="@Required" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sushi btn-sm"><i class="fa fa-paper-plane"></i> {{__('Invia Richiesta Gratuita')}}</button>
                    </form>
                </div>
                <div class="col-md-4 offset-7">
                    <div class="row row-mod-1 flow-offset-6 sidebar text-sm-center text-md-left">
                        <div class="col-xs-12 col-sm-4 col-md-12">
                            <dl class="contact-info">
                                <dt>
                                    <span class="h4 border-bottom mb-2">{{__('Sede Cortina')}}</span>
                                </dt>
                            </dl>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-12">
                            <dl class="contact-info">
                                <dt>
                                    <span class="h6"><b>{{__('Telefono')}}</b></span>
                                </dt>
                                <dd class="mt-0 mb-2">
                                    <a href="callto:00390436863886" class="text-light">+ 39 0436 863886
                                    </a>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-12">
                            <dl class="contact-info">
                                <dt>
                                    <span class="h6"><b>{{__('Email')}}</b></span>
                                </dt>
                                <dd class="mt-0 mb-2">
                                    <a href="mailto:agenzia@cortinese.it" class="text-light">agenzia@cortinese.it</a>
                                </dd>
                            </dl>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-12">
                            <address class="address">
                                <span class="h6"><b>{{__('Indirizzo')}}</b></span>
                                <p class="mt-0 ">Piazza S. Francesco 15 - 32043 <br>Cortina d'Ampezzo (BL)</p>
                            </address>
                        </div>



                        <div class="col-xs-12 col-sm-4 col-md-12 mt-3">
                            <dl class="contact-info">
                                <dt>
                                    <span class="h4 border-bottom mb-2">{{__('Sede San Vito')}}</span>
                                </dt>
                            </dl>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-12">
                            <dl class="contact-info">
                                <dt>
                                    <span class="h6"><b>{{__('Telefono')}}</b></span>
                                </dt>
                                <dd class="mt-0 mb-2">
                                    <a href="callto:0039043699020" class="text-light"> + 39 0436 99020
                                    </a>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-12">
                            <dl class="contact-info">
                                <dt>
                                    <span class="h6"><b>{{__('Email')}}</b></span>
                                </dt>
                                <dd class="mt-0 mb-2">
                                    <a href="mailto:agsanvito@cortinese.it" class="text-light">agsanvito@cortinese.it</a>
                                </dd>
                            </dl>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-12">
                            <address class="address">
                                <span class="h6"><b>{{__('Indirizzo')}}</b></span>
                                <p class="mt-0">Corso Italia 8 - 32046 <br>San Vito di Cadore (BL)</p>
                            </address>
                        </div>


                        <div class="col-xs-12 col-sm-4 col-md-12 mt-3">
                            <h4 class="border-bottom">{{__('Seguici su')}}</h4>
                            <div class="icon-group">
                                <a href="#" class="icon icon-sm icon-social" style="background:#395b98"><i class="fab fa-facebook-f"></i></a>
                                {{-- <a href="#" class="icon icon-sm icon-social fa-twitter"></a>
                                <a href="#" class="icon icon-sm icon-social fa-google-plus"></a> --}}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-12 mt-3">
                            <h4 class="border-bottom">{{__('Orari d\'apertura')}}</h4>
                            <p> {{__('Lun')}} - {{__('Sab')}}<br>9:00 - 12:30 <br> 15:30 - 19:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.elements.why-us')
    @include('layouts.elements.warranties')

@stop

@section('scripts')
    <script src="https://maps.google.com/maps/api/js?sensor=true&key=AIzaSyA7NSr7UzZHJXVGvKirRm08FIEINDXAKJ4"></script>
    <script>
        var map_init=function (){
        var ps=[[46.5367017, 12.1375607], [46.4624, 12.20476]];
        var myLatlng = new google.maps.LatLng(46.5045308,12.1387281);
        var mapOptions = {
          zoom: 11,
          center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

        $(ps).each(function(){
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(this[0],this[1]),
                map: map,
                title:""
            });
        });

        }
        $(window).load(function(){
            google.maps.event.addDomListener(window, 'load', map_init());
        });
    </script>
@stop

{{--
<div id="map-canvas" style="height:350px;width:100%"></div>
<script src="https://maps.google.com/maps/api/js?sensor=true&key=AIzaSyA7NSr7UzZHJXVGvKirRm08FIEINDXAKJ4"></script>
<script>
	var map_init=function (){
	var ps=[[46.5367017, 12.1375607], [46.4624, 12.20476]];
	var myLatlng = new google.maps.LatLng(ps[0][0],ps[0][1]);
	var mapOptions = {
	  zoom: 11,
	  center: myLatlng
	}
	var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

	// To add the marker to the map, use the 'map' property
	$(ps).each(function(){
		var marker = new google.maps.Marker({
	    position: new google.maps.LatLng(this[0],this[1]),
	    map: map,
	    title:""
	});
	});

	}
	$(window).load(function(){
		google.maps.event.addDomListener(window, 'load', map_init());
	});
</script>

 --}}
