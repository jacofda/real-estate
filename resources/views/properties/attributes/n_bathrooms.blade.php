@if($c1 < 2)
    <li>
        <span class="icon icon-sm icon-primary hotel-icon-10"></span>{{$property->n_bathrooms}} {{($property->n_bathrooms > 1) ? __('bagni') : __('bagni') }}
    </li>
@endif
