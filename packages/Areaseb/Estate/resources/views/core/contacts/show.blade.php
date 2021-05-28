@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}contacs">Contatti</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => $contact->fullname])

@section('content')

    <div class="row">

        <div class="col-md-3">

            <div class="card card-info card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        {!!$contact->avatar!!}
                        <h3 class="profile-username text-center">{{$contact->fullname}}</h3>
                        @if($contact->client_id)
                            @if($contact->client->type)
                            <p class="text-muted text-center">
                                {{$contact->client->type->name}}
                            </p>
                            @endif
                        @endif
                        @if($contact->client_id)
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item text-center" style="line-height:1rem;">
                                    <a href="{{$contact->client->url}}" >
                                        {{$contact->client->rag_soc}}
                                    </a>
                                </li>
                            </ul>
                        @endif
                        @can('contacts.write')
                            <a href="{{$contact->url}}/edit" class="btn btn-sm btn-warning btn-block"><b> <i class="fa fa-edit"></i> Modifica</b></a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Dettagli</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Indirizzo</strong>
                    <p class="text-muted">{{$contact->indirizzo}} <br>
                        {{$contact->cap}}, {{$contact->citta}} {{$contact->provincia}} {{$contact->nazione}}
                    </p>
                    <hr>

                    <strong><i class="fas fa-at mr-1"></i> Contatti</strong>
                    @if($contact->cellulare)<p class="text-muted"><b>Tel:</b> {{$contact->cellulare}}</p>@endif
                    @if($contact->email)<p class="text-muted"><b>Email:</b> <small>{{$contact->email}}</small></p>@endif
                </div>
            </div>
        </div>


        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#reports" data-toggle="tab">Reports</a></li>
                        <li class="nav-item"><a class="nav-link" href="#eventi" data-toggle="tab">Eventi</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li> --}}
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="reports">
                            @include('estate::core.contacts.components.reports')
                        </div>
                        <div class="tab-pane" id="eventi">
                            @include('estate::core.contacts.components.events')
                        </div>
                        {{-- <div class="tab-pane" id="settings">
                            Settings
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>


    </div>

@stop
