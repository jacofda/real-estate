@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Visite'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header bg-secondary-light">
                    <div class="card-tools">
                        <a href="{{route('views.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nuova Visita</a>
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
                                    <th>Data</th>
                                    <th data-sortable="false" style="width:95px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($views as $view)
                                    <tr id="row-{{$view->id}}">
                                        <td>{{$view->client->fullname}}</td>

                                        <td><b>{{strtoupper($view->property->name_it)}}</b><br>{{$view->property->city->comune}}</td>
                                        <td><p title="doppio click open" class="limited-text hoverable showAll">{{$view->note}}</td>
                                        <td data-sort="{{$view->created_at->timestamp}}">{{$view->created_at->format('d/m/Y')}}</td>
                                        <td>
                                            <a href="{{route('views.edit', $view->id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="#" data-id="{{$view->id}}" class="btn btn-xs btn-danger dlt"><i class="fa fa-trash"></i></a>
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
    $('p.showAll').on('dblclick', function(){
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
                axios.delete(baseURL+'views/'+id, {_token:token}).then(response => el.remove());
            }
        });

    });

</script>
@stop
