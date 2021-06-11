@extends('layouts.app')

@section('meta')
    <title>{{__("L'agenzia")}}</title>
@stop


@section('title')
    <section class="section-full section-full-mod-1 text-left" style="background-image:url('http://wure.s3.amazonaws.com/53db9a676a2caa0725fc7978/slider_imgs/25142ecc-7159-41d7-ad6a-5ac651580f27')">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__("L'agenzia")}}</h1>
                    <h3 class="text-white mt-0 mb-2 text-upper">Payoff goes here</h3>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li class="active">{{__("L'agenzia")}}</li>
                    </ol>
                    <hr>

                </div>
            </div>
        </div>
    </section>
@stop

@section('content')

<section class="section-md text-left about">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>Alcune parole su di noi</h2>
                <hr>
                <p class="inset-3">Vuoi trascorrere una vacanza in appartamento a Cortina, o comprare una casa nelle Dolomiti, immersa nel fascino incantevole di una località esclusiva? Contatta Immobiliare Cortinese, una delle agenzie immobiliari più prestigiose di Belluno e provincia!</p>

                <p class="inset-3">Siamo un'agenzia immobiliare con sede a Cortina. Operiamo con impegno e professionalità da oltre trent'anni nel settore immobiliare di Belluno e provincia: ci occupiamo di compravendita, affitti stagionali e affitti annuali, sia turistici che residenziali, nonché di amministrazioni e gestioni di condominio. Se siete quindi interessati all'affitto di una casa vacanze nelle Dolomiti, siete arrivati nel posto giusto!</p>
            </div>
        </div>
    </div>
</section>

<section class="section-sm bg-gray text-left">
    <div class="container text-center">
        <div class="row flow-offset-7">
            <div class="col-xs-12 col-sm-6 col-md-3">
                <span class="icon icon-primary icon-md"><i class="fa fa-trophy"></i></span>
                <p class="h6 text-white text-ubold">La miglior agenzia</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <span class="icon icon-primary icon-md"><i class="fa fa-flag"></i></span>
                <p class="h6 text-white text-ubold">Premiata nel 2019</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <span class="icon icon-primary icon-md"><i class="fa fa-graduation-cap"></i></span>
                <p class="h6 text-white text-ubold">Certificazione internazionale</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <span class="icon icon-primary icon-md"><i class="fa fa-star"></i></span>
                <p class="h6 text-white text-ubold">Raccomandata da Forbes</p>
            </div>
        </div>
    </div>
</section>

<section class="section-md text-left about">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                    <p class="inset-3">Per chi ama la montagna, Cortina e le Dolomiti costituiscono la migliore scelta possibile. La prima è oggi considerata una delle mete più ambite per gli amanti degli sport invernali, nonché un riconosciutissimo luogo ricco di fascino e glamour; le seconde, Patrimonio dell'Umanità UNESCO dal 1999, costituiscono uno degli spettacoli naturalistici più impagabili che l'Italia può offrire. Affittare una casa in montagna è la soluzione ideale per trascorrere fantastiche vacanze in un ambiente magico. Immobiliare Cortinese può aiutarvi nella scelta del vostro appartamento, o della vostra casa vacanze: disponiamo di una scelta davvero ampia di appartamenti, ville, soluzioni unifamiliari e pied-à-terre, nel mondano Corso Italia di Cortina come nei borghi più caratteristici della conca Ampezzana, di San Vito di Cadore e delle Dolomiti. Grazie alla decennale collaborazione con imprenditori, studi tecnici, costruttori e professionisti del settore immobiliare, possiamo trovare la vostra casa ideale. E nulla è per noi più gratificante di un cliente soddisfatto!</p>

                    <p class="inset-3">Se dunque vuoi trascorrere una vacanza all'insegna del benessere, della natura e della neve, immerso in una straordinaria cornice naturale, vieni a conoscerci! Nostri agenti qualificati saranno a disposizione per capire le tue esigenze e proporti le migliori soluzioni per affittare appartamenti a Cortina o case vacanza sulle Dolomiti a prezzi davvero concorrenziali.</p>
            </div>
        </div>
    </div>
</section>

@include('layouts.elements.why-us')
@include('layouts.elements.warranties')





@stop
