@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Privacy'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header bg-secondary-light">
                    <div class="card-tools">
                        <a href="{{route('privacy.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Nuova Privacy</a>
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
                                    <th data-sortable="false" style="width:120px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($privacy as $item)
                                    <tr id="row-{{ $item->id }}">
                                        <td>{{ $item->client->fullname }}</td>
                                        <td data-sort="{{ $item->created_at->timestamp }}">{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $item->signed ? 'Sì' : 'No' }}</td>
                                        <td>
                                            @if ($item->signed)
                                                <a href="{{ route('privacy.download', ['uuid' => $item->uuid] )}}" class="btn btn-xs btn-info" download><i class="fa fa-download"></i></a>
                                            @else
                                                <a href="{{ route('privacy.sign', ['uuid' => $item->uuid] )}}" class="btn btn-xs btn-info"><i class="fa fa-signature"></i></a>
                                                <a href="{{ route('privacy.sign', ['uuid' => $item->uuid] )}}" class="btn btn-xs btn-info copy"><i class="fa fa-copy"></i></a>
                                            @endif
                                            <a href="#" data-id="{{ $item->id }}" class="btn btn-xs btn-danger dlt"><i class="fa fa-trash"></i></a>
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
                axios.delete(baseURL+'privacy/'+id, {_token:token}).then(response => el.remove());
            }
        });

    });

    $('#table').on('click', 'a.copy', function (e) {
        e.preventDefault()

        let link = $(this).attr('href')
        let $temp = $('<input>')

        $('body').append($temp);
        $temp.val(link).select();
        document.execCommand("copy");

        $temp.remove();

        alert('Link copiato');
    })

</script>
@stop
