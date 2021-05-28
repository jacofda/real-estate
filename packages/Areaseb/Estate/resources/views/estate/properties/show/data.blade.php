@if($property->contract->name_it = 'Affitto')

    <li class="list-group-item d-flex justify-content-between align-items-center"><span>Prezzo:</span>
        @if($property->show_price)
            <p class="mb-0"><span title="visibile" class="badge badge-pill badge-success"><i class="far fa-eye"></i></span> <b>{{$property->rent_price ?? 'MANCANTE'}}</b></p>
        @else
            <p class="mb-0"><span title="non visibile" class="badge badge-pill badge-secondary"><i class="far fa-eye-slash"></i></span> <b>{{$property->rent_price ?? 'MANCANTE'}}</b></p>
        @endif
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center"><span>Periodo:</span><b>{{$property->rent_period ?? 'MANCANTE'}}</b></li>

@elseif($property->contract->name_it = 'Vendita')

    <li class="list-group-item d-flex justify-content-between align-items-center"><span>Prezzo:</span>
        @if($property->show_price)
            <p class="mb-0"><span title="visibile" class="badge badge-pill badge-success"><i class="fa fa-eye"></i></span> {{$property->sell_price ?? 'MANCANTE'}}</p>
        @else
            <h4><span class="badge badge-pill badge-secondary">{{$property->sell_price ?? 'MANCANTE'}}</span></h4>
        @endif
    </li>

@else

    <li class="list-group-item d-flex justify-content-between align-items-center"><span>Prezzo Vendita:</span>
        @if($property->show_price)
            <p class="mb-0"><span title="visibile" class="badge badge-pill badge-success"><i class="fa fa-eye"></i></span> {{$property->sell_price ?? 'MANCANTE'}}</p>
        @else
            <p class="mb-0"><span class="badge badge-pill badge-secondary">{{$property->sell_price ?? 'MANCANTE'}}</span></p>
        @endif
    </li>

    <li class="list-group-item d-flex justify-content-between align-items-center"><span>Prezzo Affitto:</span>
        @if($property->show_price)
            <p class="mb-0"><span title="visibile" class="badge badge-pill badge-success"><i class="fa fa-eye"></i></span> {{$property->rent_price ?? 'MANCANTE'}}</p>
        @else
            <p class="mb-0"><span class="badge badge-pill badge-secondary">{{$property->rent_price ?? 'MANCANTE'}}</span></p>
        @endif
    </li>

@endif

@if($property->address)

    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>Indirizzo:</span>
        @if($property->show_address)
            <p class="mb-0"><span title="visibile" class="badge badge-pill badge-success"><i class="fa fa-eye"></i></span> {{$property->address}}</p>
        @else
            <p class="mb-0"><span title="visibile" class="badge badge-pill badge-secondary"><i class="fa fa-eye-slash"></i></span> {{$property->address}}</p>
        @endif
    </li>
@endif

@if($property->state)

    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>Stato:</span>
        <p class="mb-0"><b>{{$property->state}}</b></p>
    </li>

@endif

@if($property->heating)

    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>Riscaldamento:</span>
        <p class="mb-0"><b>{{$property->heating}}</b></p>
    </li>

@endif

@if($property->energy_class)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>Classe Energetica:</span>
        <p class="mb-0"><b>{{$property->energy_class}}</b></p>
    </li>
@endif
