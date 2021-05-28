@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Bookings'])

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
                                    <th>Affituario</th>
                                    <th>Immobile</th>
                                    <th>Da</th>
                                    <th>A</th>
                                    <th data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                    <tr id="row-{{$booking->id}}">
                                        <td>{{$booking->contact->fullname}}</td>
                                        <td>{{$booking->property->name_it}}</td>
                                        <td>{{$booking->from_date->format('d/m/Y')}}</td>
                                        <td>{{$booking->to_date->format('d/m/Y')}}</td>
                                        <td>
                                            <a href="#" data-id="{{$booking->id}}" class="btn btn-xs btn-danger dlt"><i class="fa fa-trash"></i></a>
                                            <a href="{{route('bookings.edit', $booking->id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                            <a href="{{route('bookings.media', $booking->id)}}" class="btn btn-xs btn-info"><i class="fa fa-image"></i></a>
                                            <a href="{{route('bookings.show', $booking->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>
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

              axios.delete(baseURL+'bookings/'+id, {_token:token}).then(response => $('tr#row-'+id).remove());
          }
        })

    });

</script>
@stop
