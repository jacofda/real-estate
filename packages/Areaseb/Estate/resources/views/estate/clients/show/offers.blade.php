@php
    $hide = $client->offers->isEmpty();
@endphp


<div class="card @if($hide) collapsed-card @endif">
    <div class="card-header bg-Offer">
        <h3 class="card-title l15">Proposte</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse"><i class="fas @if($hide) fa-plus @else fa-minus @endif"></i></button>
            <button title="aggiungi proposta" class="btn btn-xxs btn-primary newOffer"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body"></div>
</div>

@include('estate::estate.clients.show.offer-modal')
