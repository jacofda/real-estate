<div class="col-sm-6">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0 text-uppercase card-title" style="line-height:1.4rem;"> {{$property->tag->name_it}} <small>in</small> {{$property->contract->name_it}}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <a title="gestisci dati immobile" href="{{route('properties.edit', $property->id)}}" class="btn btn-tool text-dark"><i class="far fa-edit"></i></button></a>
            </div>

        </div>
        <div class="card-body p-0">
            <div class="row">
                <div class="col-sm-8">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center"><span>Rif:</span><b>{{$property->rif}}</b></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center"><span>Località:</span><b>{{$property->city->comune}}</b></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center"><span>Nome:</span><b>{{$property->name}}</b></li>
                        @include('estate::estate.properties.show.data')
                    </ul>
                </div>
                @include('estate::estate.properties.show.map')
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dettagli</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <a title="gestisci dati immobile" href="{{route('properties.edit', $property->id)}}" class="btn btn-tool text-dark"><i class="far fa-edit"></i></button></a>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                @if($property->n_rooms)
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i title="totale stanze" class="far fa-square"></i> <b>{{$property->n_rooms}}</b></li>
                        </ul>
                    </div>
                @endif
                @if($property->n_bedrooms)
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i title="camere da letto" class="fas fa-bed"></i> <b>{{$property->n_bedrooms}}</b></li>
                        </ul>
                    </div>
                @endif
                @if($property->n_bathrooms)
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i title="bagni" class="fas fa-bath"></i> <b>{{$property->n_bathrooms}}</b></li>
                        </ul>
                    </div>
                @endif
                @if($property->n_garages)
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i title="garage" class="fas fa-car"></i> <b>{{$property->n_garages}}</b></li>
                        </ul>
                    </div>
                @endif
                @if($property->n_floors)
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i title="piani" class="fas fa-layer-group"></i> <b>{{$property->n_floors}}</b></li>
                        </ul>
                    </div>
                @endif
            </div>
            <div class="row">
                @if($property->surface)
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i title="mq immobile" class="fas fa-home"></i> <b>{{$property->surface}}</b></li>
                        </ul>
                    </div>
                @endif

                @if($property->garden_surface)
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i title="mq giardino" class="fas fa-tree"></i> <b>{{$property->garden_surface}}</b></li>
                        </ul>
                    </div>
                @endif

                @if($property->land_surface)
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><i title="mq totale lotto" class="fas fa-tree"></i> <b>{{$property->land_surface}}</b></li>
                        </ul>
                    </div>
                @endif

            </div>
            <div class="mt-3">
                @foreach($property->feats->chunk(4) as $chunk)
                    <div class="row">
                        @foreach ($chunk as $feat)
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        {{$feat->name_it}}
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>
        <div class="card-footer">
            {!!$property->desc_it!!}
        </div>
    </div>

    @include('estate::estate.properties.show.calendar')

</div>
