@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}sheets">Fogli di visita</a></li>
@stop

@include('estate::layouts.elements.title', ['title' => 'Crea Foglio di visita'])

@section('css')
    <style>
        .step-title {
            font-size: 0.875rem;
            line-height: 0.875rem;
        }
    </style>
@stop

@section('content')

    <div class="row">
        @include('estate::components.errors')

        <div class="col-md-8 offset-md-2">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Nuovo foglio di visita</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <h4 class="step-title">1. Scegli il cliente</h4>
                            <div class="form-group">
                                {!! Form::select('client_id', $clients, request('client_id'), ['id' => 'client']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="d-none" id="client-new">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome']) !!}
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::text('cognome', null, ['class' => 'form-control', 'placeholder' => 'Cognome']) !!}
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email*']) !!}
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Telefono']) !!}
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::text('citta', null, ['class' => 'form-control', 'placeholder' => 'Comune/Città']) !!}
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <button class="btn btn-success" id="saveQuickContact">Crea Contatto</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer p-0">
                    <form action="{{ route('privacy.store') }}" method="POST" autocomplete="off">
                        {!! Form::hidden('client_id', request('client_id')) !!}
                        @csrf

                        <button class="btn btn-primary btn-sm btn-block btn-save-view" id="submit-privacy" @if (!request('client_id')) disabled @endif> <i class="fa fa-save"></i> Salva</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop

@section('scripts')
<script>

    function initClientSelect2(data = null) {
        $('#client').select2({width:'100%', placeholder:"Seleziona o crea contatto"})
    }

    $('#client').on('change', function () {
        let $this = $(this)

        if ($this.val() == 'new') {
            // Open form to create client
            $('#client-new').removeClass('d-none')
            return
        }

        // Let's save the client_id
        // and update the view options
        $('#client-new').addClass('d-none')
        $("input[name='client_id']").val($(this).val())
        $('#submit-privacy').prop('disabled', false)
    });

    $('#saveQuickContact').on('click', function(e){
        e.preventDefault()
        let data = {};
        data._token = token;
        data.nome = $('input[name="nome"]').val();
        data.cognome = $('input[name="cognome"]').val();
        data.email = $('input[name="email"]').val();
        data.mobile = $('input[name="mobile"]').val();
        data.citta = $('input[name="citta"]').val();

        if (data.email == "") {
            return false;
            err('Email è obbligatoria');
        }

        axios.post(baseURL+'request-create-contact', data, function (response) {
            pass('Contatto Aggiunto');

            $('#client-new').addClass('d-none')
            $("input[name='client_id']").val(response)
        })
    });

    initClientSelect2()
</script>
@stop
