@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Fogli di visita'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header bg-secondary-light">
                    <div class="card-tools">
                        <a href="{{route('sheets.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nuovo Foglio di visita</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table id="table" class="table table-sm table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>Richiedente</th>
                                    <th>Data</th>
                                    <th>Firmato</th>
                                    <th data-sortable="false" style="width:95px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sheets as $sheet)
                                    <tr id="row-{{ $sheet->id }}">
                                        <td>{{ $sheet->client->fullname }}</td>
                                        <td data-sort="{{ $sheet->created_at->timestamp }}">{{ $sheet->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $sheet->signed ? 'Sì' : 'No' }}</td>
                                        <td>
                                            @if ($sheet->signed)
                                                <a href="{{ route('sheets.download', ['uuid' => $sheet->uuid] )}}" class="btn btn-xs btn-info" download><i class="fa fa-download"></i></a>
                                            @else
                                                <a href="{{ route('sheets.sign', ['uuid' => $sheet->uuid] )}}" class="btn btn-xs btn-info"><i class="fa fa-signature"></i></a>
                                            @endif
                                            @if (!$sheet->signed)
                                                <a href="{{ route('sheets.edit', $sheet->id )}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            <a href="#" data-id="{{ $sheet->id }}" class="btn btn-xs btn-danger dlt"><i class="fa fa-trash"></i></a>
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
                axios.delete(baseURL+'sheets/'+id, {_token:token}).then(response => el.remove());
            }
        });

    });

</script>
@stop
