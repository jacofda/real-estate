@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Richieste'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary-light">
                    <div class="card-tools">
                        <a href="{{route('requests.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nuova Richiesta</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-sm table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Richiedente</th>
                                    <th>Immobile</th>
                                    <th>Note</th>
                                    {{-- <th>Data Richiesta</th> --}}
                                    <th data-sortable="false" style="min-width:95px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $request)
                                    <tr id="row-{{$request->id}}">
                                        <td data-sort="{{$request->created_at->timestamp}}"><i>{{$request->client->fullname}}</i><br>{{$request->created_at->format('d/m/Y')}}</td>
                                        <td><b>{{strtoupper($request->property->name_it)}}</b><br>{{$request->property->city->comune}}</td>
                                        <td><p title="doppio click open" class="limited-text hoverable showAll">{{$request->note}}</td>
                                        <td>
                                            <a href="#" data-id="{{$request->id}}" class="btn btn-xs btn-danger dlt"><i class="fa fa-trash"></i></a>
                                            <a title="trasforma in visita" href="{{route('views.create')}}?client_id={{$request->client_id}}&property_id={{$request->property_id}}" class="btn btn-xs btn-primary"><i class="far fa-calendar"></i> set visita</a>
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
    $('#table').on('dblclick','p.showAll', function(){
        $(this).toggleClass('limited-text');
    });
    $('#table').dataTable(window.tableOptions);
    $('#table').on('click', 'a.dlt', function(e){
        e.preventDefault();

        let id = $(this).attr('data-id');
        let el = $('tr#row-'+$(this).attr('data-id'));

        Swal.fire({
            title: 'Siete Sicuri',
            text: "Questa azione eliminerà tutte le relazioni associate",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sì. elimina!',
            cancelButtonText: 'Annulla!'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(baseURL+'requests/'+id, {_token:token}).then(response => el.remove());
            }
        });




    });
</script>
@stop
