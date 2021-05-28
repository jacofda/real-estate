@php
    $hide = true;//$client->sheets->isEmpty();
@endphp


<div class="card @if($hide) collapsed-card @endif">
    <div class="card-header bg-Sheet">
        <h3 class="card-title l15">Fogli di visita</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse"><i class="fas @if($hide) fa-plus @else fa-minus @endif"></i></button>
        </div>

    </div>
    <div class="card-body"></div>
</div>
