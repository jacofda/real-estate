{!! Form::hidden('previous_url', url()->previous()) !!}

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Intestatario Contratto</label>
            {!! Form::select('client_id', $clients, request('client_id') ?? null) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Immobile</label>
            {!! Form::select('property_id', $properties, request('property_id') ?? null, ['id' => 'selectPropertiesRequest']) !!}
        </div>
    </div>
</div>


@push('scripts')
<script>
    $('select[name="client_id"]').select2({width:'100%', placeholder:'Seleziona il proprietario'});
    $('select[name="property_id"]').select2({width:'100%', placeholder:'Seleziona la proprietà'});
</script>
@endpush
