@if($c1 < 2)
    @if(strlen($property->energy_class) === 1)
        <li>
            <span class="icon-sm icon-primary" style="font-size: 20px;margin-right:5px;"> {{$property->energy_class}}</span> {{__('classe energetica') }}
        </li>
    @endif
@endif
