@if($c2 < 2)
    <li>
        <span class="icon icon-sm icon-primary hotel-icon-05"></span>{{$property->n_bedrooms}} {{($property->n_bedrooms > 1) ? __('camere') : __('camera') }}
    </li>
@endif
