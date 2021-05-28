@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Clienti'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary-light">
                    <div class="row">
                        <div class="col-sm-2 offset-sm-10 text-right" style="float:right">
                            <div class="form-group mb-0">
                                <a class="btn btn-primary" href="{{route('clients.create')}}"><i class="fa fa-plus"></i> Cliente</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    {{-- @include('estate::core.companies.components.advanced-search', ['url_action' => 'companies']) --}}

                    <div class="table-responsive">
                        <table id="table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Ragione Sociale</th>
                                    <th>Contatto</th>
                                    {{-- <th>Preferenze</th> --}}
                                    <th>Tipo</th>
                                    <th>Origine</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    @can('companies.write')
                                        <th data-orderable="false"></th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->rag_soc}}</td>
                                        <td>
                                            {{$client->primary->fullname}}
                                            <a href="{{route('contacts.edit', $client->primary->id)}}" title="modifica contatto" class="badge badge-warning btn-xs"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td>{{$client->type->name}}</td>
                                        <td>{{$client->origin}}</td>
                                        <td>{{$client->email}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td>
                                            <a href="{{route('clients.show', $client->id)}}" class="btn btn-primary btn-xxs"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
    let startTime = Date.now();

    let myOptions =  {
        deferRender: true,
        aaSorting: [],
        responsive: true,
        autoWidth: false,
        pageLength: 30,
        bLengthChange: false,
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Cerca clienti...',
            lengthMenu: '_MENU_',
            info: "_START_ di _END_ su _TOTAL_",
            zeroRecords: "Non ci sono dati",
            infoEmpty: "Non ci sono dati",
            paginate: {
                first:      "Primo",
                previous:   "<",
                next:       ">",
                last:       "Ultimo"
            },
        },
        initComplete: function() {
            console.log('DT init complete in ', Date.now() - startTime + ' milliseconds.');
        }
    }

    let table = $('#table').DataTable(myOptions);

    </script>
@stop
