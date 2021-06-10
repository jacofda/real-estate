<div class="table-responsive">
    <table class="table table-sm table-bordered table-striped table-php">
        <thead>
            <tr>
                <th style="width:40px;">#</th>
                <th>Tipo</th>
                <th>Nome</th>
                <th data-field="rif" data-order="asc">Rif <i class="fas fa-sort"></i></th>
                <th>Tag</th>
                <th>Area</th>
                <th>Prezzo</th>
                <th>Richieste</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
                <tr id="row-{{$property->id}}">
                    <td>
                        @if(!$property->media->isEmpty())
                            <a href="{{asset('storage/properties/full/'.$property->media[0]->filename)}}"><img style="width:40px;" src="{{asset('storage/properties/thumb/'.$property->media[0]->filename)}}"></a>
                        @endif
                    </td>
                    <td>{{$property->contract->name}}</td>
                    <td><a href="{{route('properties.show', $property->id)}}">{{$property->name}}</a></td>
                    <td class="text-center">{{$property->rif}}</td>
                    <td>
                        @if($property->tag)
                            {{$property->tag->name}}
                        @else
                            MISSING
                        @endif
                    </td>
                    <td>
                        @if($property->city)
                            {{$property->city->comune}}
                            @if($property->area)
                                <br>{{$property->area->name}}
                            @endif
                        @else
                            MISSING
                        @endif
                    </td>
                    <td>{{$property->sell_price ?? $property->rent_price}}</td>
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
