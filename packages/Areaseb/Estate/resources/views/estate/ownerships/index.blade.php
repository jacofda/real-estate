@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Atti di proprietà'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary-light">


                </div>
                <div class="card-body">

                    <div class="table-responsive">


                        <table id="table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Proprietario</th>
                                    <th>Immobile</th>
                                    <th>Area</th>
                                    <th>Data Acquisto</th>
                                    <th data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ownerships as $ownership)
                                    <tr id="row-{{$ownership->id}}">
                                        <td>{{$ownership->client->fullname}}</td>
                                        <td>{{$ownership->property->name_it}}</td>
                                        <td>{{$ownership->property->city->comune}}</td>
                                        <td data-sort="{{$ownership->from->timestamp}}">{{$ownership->from->format('d/m/Y')}}</td>
                                        <td>
                                            <a href="#" data-id="{{$ownership->id}}" class="btn btn-xs btn-danger dlt"><i class="fa fa-trash"></i></a>
                                            <a href="{{route('ownerships.show', $ownership->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
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
    $('#table').dataTable(window.tableOptions);
    $('#table').on('click', 'a.dlt', function(e){
        e.preventDefault();
        let id = $(this).attr('data-id');
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
              $('tr#row-'+id).remove();
            //axios.delete(baseURL+'companies/'+id, {_token:token}).then(response => this.results.splice(index,1));
          }
        })

    });

</script>
@stop
