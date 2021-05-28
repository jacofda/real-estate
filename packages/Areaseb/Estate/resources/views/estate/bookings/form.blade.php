<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Intestatario Contratto</label>
            {!! Form::select('contact_id', $contacts, request('contact_id') ?? null, ['id' => 'selectContactrequest']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Immobile</label>
            {!! Form::select('property_id', $properties, request('property_id') ?? null, ['id' => 'selectPropertiesRequest']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Periodo</label>
            {!! Form::select('rent_period', ['giorno' => 'Giorno', 'settimana' => 'Settimana', 'mese' => 'Mese'], null, ['class' => 'custom-select']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>Affitto</label>
            <div class="input-group">
                {!! Form::text('amount', null, ['class' => 'form-control input-decimal']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-euro-sign"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Da giorno</label>

            <div class="input-group date" id="from_date" data-target-input="nearest">
                <input type="text" name="from_date" class="form-control datetimepicker-input" data-target="#from_date" value="{{ isset($booking) ? $booking->from_date->format('d/m/Y') : date('d/m/Y') }}"/>
                <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label>A giorno</label>

            <div class="input-group date" id="to_date" data-target-input="nearest">
                <input type="text" name="to_date" class="form-control datetimepicker-input" data-target="#to_date" value="{{ isset($booking) ? $booking->to_date->format('d/m/Y') : date('d/m/Y')}}"/>
                <div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="form-group">
    <label>Note</label>
    {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>


@section('scripts')
<script>
    $('#selectContactrequest').select2({width:'100%', placeholder:"Seleziona o crea contatto"});
    $('#selectPropertiesRequest').select2({width:'100%', placeholder:"Seleziona immobile"});
    $('#from_date').datetimepicker({format:'DD/MM/YYYY'});
    $('#to_date').datetimepicker({format:'DD/MM/YYYY'});
</script>
@stop
