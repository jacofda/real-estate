@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Proprietà'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- @include('estate::estate.properties.index.header') --}}
                <div class="card-body">

                    @include('estate::estate.properties.index.advanced-search')

                    @include('estate::estate.properties.index.table-dt')
                </div>
            </div>
        </div>
    </div>
@stop
