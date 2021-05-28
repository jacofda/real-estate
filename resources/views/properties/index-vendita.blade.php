@extends('layouts.app')

@section('meta')
<title> Immobili in Vendita</title>
@stop

@section('title')
<section class="section-full section-full-mod-1 text-left">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Immobili in Vendita</h1>
                <p></p>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('welcome')}}">Home</a>
                    </li>
                    <li class="active">Immobili in Vendita</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@stop

@section('search')
@stop

@section('content')

<section class="section-md section-mod-1 text-left">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-3 pull-xs-left text-center text-sm-left">
                <div class="sort-input">
                    <div class="form-group form-group-mod-1">
                        <label for="sort-1" class="form-label">Sorting</label>
                        <select id="sort-1" data-minimum-results-for-search="Infinity" class="form-control select-filter">
                            <option value="By Price" selected="selected">By Price</option>
                            <option value="By Date">By Date</option>
                            <option value="By Square">By Square</option>
                            <option value="By Location">By Location</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 pull-xs-right text-center text-sm-right">
                <div class="btn-group-mod-3 sorting">
                    <a href="#" class="btn btn-primary-transparent btn-sm active">List</a>
                    <a href="#" class="btn btn-primary-transparent btn-sm">Grid</a>
                </div>
            </div>

        </div>

        <div class="row">

            @include('properties.index.grid')


        </div>

    </div>
</section>

@stop
