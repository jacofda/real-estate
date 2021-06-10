@if($c1 < 2)
    <li>
        <span class="icon icon-sm icon-primary hotel-icon-19"></span>{{$property->n_floors}} {{($property->n_floors > 1) ? __('piani') : __('piano') }}
    </li>
@endif
