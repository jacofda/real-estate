<div class="col-md-6">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Nominativo</h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Titolo</label>
                        {!! Form::select('pos', $pos, null, ['class' => 'form-control add-select']) !!}
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Nome</label>
                        {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
                        @include('estate::components.add-invalid', ['element' => 'nome'])
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Cognome</label>
                {!! Form::text('cognome', null, ['class' => 'form-control', 'required']) !!}
                @include('estate::components.add-invalid', ['element' => 'cognome'])
            </div>

            <div class="form-group">
                <label>Email</label>
                {!!Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Indirizzo Email', 'required', 'autocomplete' => 'off'])!!}
                @include('estate::components.add-invalid', ['element' => 'email'])
            </div>

            <div class="form-group">
                <label>Mobile</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="changePrefix"></span>
                    </div>
                    {!!Form::text('cellulare', null, ['class' => 'form-control', 'placeholder' => 'Cellulare'])!!}
                </div>
            </div>

        </div>
    </div>

    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">Associa Contatto</h3>
        </div>
        <div class="card-body">

            <div class="form-group">
                <label>Cliente</label>
                {!! Form::select('client_id', $clients, request('client_id'), [
                    'class' => 'form-control select2bs4',
                    'data-placeholder' => "Seleziona un'azienda",
                    'style' => 'width:100%']) !!}
            </div>

            <div class="form-group">
                <label>Utente</label>
                {!! Form::select('user_id', $users, null, [
                    'class' => 'form-control select2bs4',
                    'data-placeholder' => "Seleziona un utente",
                    'style' => 'width:100%']) !!}
            </div>

        </div>
    </div>

</div>

<div class="col-md-6">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Indirizzo</h3>
        </div>
        <div class="card-body">

            <div class="form-group">
                <label>Nazione</label>
                {!! Form::select('nazione', $countries, null, ['class' => 'custom-select', 'id' => 'country']) !!}
            </div>

            <div class="form-group">
                <label>indirizzo</label>
                {!!Form::text('indirizzo', null, ['class' => 'form-control', 'placeholder' => 'Indirizzo'])!!}
            </div>
            <div class="form-group">
                <label>Città</label>
                {!!Form::text('citta', null, ['class' => 'form-control', 'placeholder' => 'Città'])!!}
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>CAP</label>
                        {!!Form::text('cap', null, ['class' => 'form-control', 'placeholder' => 'CAP'])!!}
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label>Provincia</label>

                        {!!Form::text('provincia', null, [
                            'class' => 'form-control',
                            'placeholder' =>'Regione Estera',
                            'id' => 'region'])!!}

                        {!! Form::select('provincia', $provinces, null, [
                            'class' => 'form-control select2bs4',
                            'data-placeholder' => 'Seleziona una provincia',
                            'style' => 'width:100%',
                            'id' => 'provincia']) !!}
                        </div>

                </div>
            </div>

        </div>
    </div>

    <div class="card card-outline card-danger">
        <div class="card-header">
            <h3 class="card-title">Tipologia</h3>
        </div>
        <div class="card-body">
            <div class="row">

                @php
                    $subscribed = 0;
                    if(isset($contact))
                    {
                        $subscribed = $contact->subscribed;
                    }
                @endphp

                <div class="col-6">
                    <div class="form-group">
                        <label>Newsletter</label>
                        {!! Form::select('subscribed', [0=>'No',1=>'Sì'], $subscribed, [
                            'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Liste</label>
                        @isset($contact)
                            {!! Form::select('list_id[]', $lists, $contact->lists()->pluck('lists.id'), [
                                'class' => 'form-control select2bs4',
                                'multiple' => 'multiple',
                                'data-placeholder' => 'Aggiungi contatto ad una lista',
                                'style' => 'width:100%']) !!}
                        @else
                            {!! Form::select('list_id[]', $lists, old('list_id') ?? null, [
                                'class' => 'form-control select2bs4',
                                'multiple' => 'multiple',
                                'data-placeholder' => 'Aggiungi contatto ad una lista',
                                'style' => 'width:100%']) !!}
                        @endisset
                    </div>
                </div>

                @php

                    $origin = 'Manuale';
                    if(isset($contact))
                    {
                        $origin = $contact->origin;
                    }
                @endphp

                <div class="col-6">
                    <div class="form-group">
                        <label>Origine</label>
                        {!! Form::select('origin', $origins, $origin, [
                            'class' => 'form-control add-tag',
                            'data-placeholder' => 'Origine del cliente',
                            'style' => 'width:100%',
                            'required']) !!}
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="card">

        <button type="submit" class="btn btn-block btn-success btn-lg" id="submitForm"><i class="fa fa-save"></i> Salva</button>

    </div>

</div>


@section('scripts')
<script>

    $('.add-select').select2({tags: true, placeholder: 'Sig, Dott ..'});
    $('.add-tag').select2({tags: true, placeholder: 'Origine contatto'});

    $('input[name="citta"').on('focusout', function(){
        $.post("{{route('api.city.zip')}}", {_token: token, citta: $(this).val()}).done(function( data ) {
            $('input[name="cap"]').val(data.cap);
            $('select[name="provincia"]').val(data.provincia);
            $('select[name="provincia"]').trigger('change');
        });
    });

    function prefix()
    {
        $.post("{{url('api/countries')}}", {
            _token: $('input[name="_token"]').val(),
            iso: $('select#country').find(':selected').val()
        }).done(function(data){
            if(data !== null)
            {
                $('span#changePrefix').text('+'+data);
                if(data != '39')
                {
                    $('select#provincia').select2('destroy').hide();
                    $('input#region').show();
                }
                else
                {
                    $('select#provincia').select2().show();
                    $('input#region').hide();
                }
            }
        });
    }

    prefix();

    $('select#country').on('change', function(){
        prefix();
    });

    $('button#submitForm').on('click', function(e){
        e.preventDefault();
        let region = $('input#region');
        let province = $('select#provincia');

        if(region.val() == '')
        {
            region.val(province.val());
        }
        if(province.val() == '')
        {
            province.val(region.val());
        }

        $('form#contactForm').submit();
    })

</script>
@stop
