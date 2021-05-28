<div class="table-responsive">
    <table id="table" class="table table-sm table-bordered table-striped">
        <thead>
            <tr>
                <th data-sortable="false" style="width:40px;"></th>
                <th>Tipo</th>
                <th>Nome</th>
                <th>Rif </th>
                <th>Tag</th>
                <th>Area</th>
                <th>Prezzo</th>
                <th>Richieste</th>
                <th data-sortable="false"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
                <tr id="row-{{$property->id}}">
                    <td>
                        @if(!$property->media->isEmpty())
                            <a href="{{asset('storage/properties/full/'.$property->media[0]->filename)}}"><img style="width:40px;" class="lazyload" data-src="{{asset('storage/properties/thumb/'.$property->media[0]->filename)}}"></a>
                        @endif
                    </td>
                    <td>{{$property->contract->name}}</td>
                    <td><a href="{{route('properties.show', $property->id)}}">{{$property->name}}</a></td>
                    <td class="text-center">{{$property->rif}}</td>
                    <td>
                        @if($property->tag)
                            {{$property->tag->name}}
                        @endif
                    </td>
                    <td>
                        @if($property->city)
                            {{$property->city->comune}}
                            @if($property->area)
                                <br>{{$property->area->name}}
                            @endif
                        @endif
                    </td>
                    <td data-sort="{{$property->sell_price ?? $property->rent_price}}">{{number_format($property->sell_price, 2, ',', '.') ?? number_format($property->rent_price, 2, ',', '.')}}</td>
                    <td>
                        @if(!$property->requests->isEmpty())
                            {{$property->requests->count()}}
                        @else
                            0
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['method' => 'delete', 'url' => route('properties.destroy', $property->id), 'id' => "form-".$property->id]) !!}
                            <a href="{{route('properties.edit', $property->id)}}" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="{{route('properties.media', $property->id)}}" class="btn btn-info btn-icon btn-sm"><i class="fa fa-image"></i></a>
                            <button type="submit" id="{{$property->id}}" class="btn btn-danger btn-icon btn-sm delete"><i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
    <script>

    lazyload();

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
            searchPlaceholder: 'Cerca immobili...',
            lengthMenu: '_MENU_',
            info: "_START_ di _END_ su un totale di _TOTAL_",
            zeroRecords: "Non ci sono dati",
            infoEmpty: "Non ci sono dati",
            paginate: {
                first:      "Primo",
                previous:   "Precedente",
                next:       "Successivo",
                last:       "Ultimo"
            },
        },
        initComplete: function() {
            console.log('DT init complete in ', Date.now() - startTime + ' milliseconds.');
        }
    }




    // $.fn.dataTable.ext.search.push(
    //     function( settings, data, dataIndex ) {
    //         var min = $('#min').val() * 1000;
    //         var max = $('#max').val() * 1000;
    //         var pv = data[6] || 0;
    //
    //         let p = 0;
    //
    //         if(pv.includes(','))
    //         {
    //             p = pv.split(',')[0];
    //             p = p.replaceAll('.', '');
    //             p = parseInt(p);
    //         }
    //
    //
    //         if ( ( min == '' && max == '' ) ||
    //              ( min == '' && p <= max ) ||
    //              ( min <= p && '' == max ) ||
    //              ( min <= p && p <= max ) )
    //         {
    //             return true;
    //         }
    //         return false;
    //     }
    // );


    console.log(Date.now())
        let table = $('#table').DataTable(myOptions);

        // $('#min, #max').keyup( function() {
        //     table.draw();
        // } );

    </script>
@endpush
