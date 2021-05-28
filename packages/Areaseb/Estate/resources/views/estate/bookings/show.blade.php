@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}bookings">Booking</a></li>
@stop

@section('css')
<style>
.expandable tr:hover{cursor:pointer;}
</style>
@stop

@include('estate::layouts.elements.title', ['title' => 'Booking '.$property->name_it])

@section('content')

    <div class="row">

        <div class="col-md-3">

            <div class="card">

                <div class="card-header bg-secondary">
                    <h3 class="card-title">Affituario</h3>
                </div>
                <div class="card-body">
                    {{$booking->contact->fullname}}
                </div>

                <div class="card-header">
                    <h3 class="card-title">Proprietario</h3>
                </div>
                <div class="card-body">
                    @if($owner)
                        {{$owner->fullname}}
                    @else
                        <a href="{{route('ownerships.create')}}?property_id={{$property->id}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Aggiungi Proprietario</a>
                    @endif
                </div>

                <div class="card-header">
                    <h3 class="card-title">Periodo</h3>
                </div>
                <div class="card-body">
                    <p class="mb-0">da {{$booking->from_date->format('d/m/Y')}} a {{$booking->to_date->format('d/m/Y')}}</p>
                </div>


                <div class="card-header">
                    <h3 class="card-title">Affitto</h3>
                </div>
                <div class="card-body">
                    <p class="mb-0">€{{number_format($booking->amount, 2, ',', '.')}}/{{$booking->rent_period}} </p>
                </div>


            </div>

        </div>

        <div class="col-md-9">
            <div class="row">




            </div>
        </div>


    </div>

@stop

@section('scripts')
<script src="{{asset('js/global-properties.js')}}"></script>

@stop
