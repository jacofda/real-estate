@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Proprietà'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('estate::estate.properties.index.header')
                <div class="card-body">
                    @include('estate::estate.properties.index.advanced-search')

                    @include('estate::estate.properties.index.table')

                </div>
                <div class="card-footer text-center">
                    <p class="text-left text-muted">{{$properties->count()}} of {{ $properties->total() }} proprietà</p>
                    {{ $properties->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
