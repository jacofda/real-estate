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

                    <div id="form" class="d-none">
                        <form action="{{ route('sheets.store') }}" method="POST" autocomplete="off" id="sheet-new">
                            {!! Form::hidden('previous_url', url()->previous()) !!}
                            {!! Form::hidden('client_id', request('client_id')) !!}
                            @csrf

                            <div class="row">

                                <div class="col-12">
                                    <h4 class="step-title mb-3">2. Scegli le visite da aggiungere al foglio di visita</h4>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered table-striped ">
                                            <thead>
                                                <tr>
                                                    <td>Visita</td>
                                                    <th data-sortable="false" style="width:95px;"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="view-list">
                                                {{-- Loaded using  --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <div class="row">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    {!! Form::select('views', $views, null, ['id' => 'views']) !!}
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button id="add-view" class="btn btn-primary btn-sm btn-block btn-save-view"> <i class="fa fa-save"></i> Aggiungi</button>
                                </div>
                            </div>

                        </div>

                        <form class="d-none" id="view-new">
                            {!! Form::hidden('client_id', request('client_id')) !!}

                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::select('property_id', $properties, request('property_id'), ['id' => 'properties']) !!}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group date" id="schedule" data-target-input="nearest">
                                            <input type="text" name="created_at" class="form-control datetimepicker-input" data-target="#schedule" value="{{date('d/m/Y H:i')}}"/>
                                            <div class="input-group-append" data-target="#schedule" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::textarea('note', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Riassunto veloce della richiesta']) !!}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card-footer p-0">
                    <button class="btn btn-primary btn-sm btn-block btn-save-view" id="submit-sheet" disabled> <i class="fa fa-save"></i> Salva</button>
                </div>
            </div>
        </div>

    </div>

@stop

@section('scripts')
<script>


@if( request('client_id') )
    $('#form').removeClass('d-none')
@endif

    function updateViewsOptions(client_id, callback) {
        $.get(`/api/sheets/client/${client_id}/views`, function (response) {
            let data = [];
            for (const key in response) {
                data.push({
                    id: key,
                    text: response[key],
                })
            }

            initViewsSelect2(data)

            // Let's call the callback
            callback()
        });
    }

    // Add view to the list for the sheet creation
    function addViewToList(data) {
        let view = $(`<tr class="view">
                        <td>
                            <input type="hidden" name="view[]" value="${data.id}" />
                            <span>${data.text}</span>
                        </td>
                        <td><a href="#" class="btn btn-xs btn-danger dlt"><i class="fa fa-trash"></i></a></td>
                    </tr>`)

        // Disable the option, delect the select and append the row into the table
        $("#views > option[value='" + data.id + "']").prop('disabled', true)
        $("#views > option").not(':disabled').prop('selected', true)
        $('#view-list').append(view)

        // Let's enable the submit button
        $('#submit-sheet').prop('disabled', false)
    }

    function initClientSelect2(data = null) {
        $('#client').select2({width:'100%', placeholder:"Seleziona o crea contatto"})
    }

    function initViewsSelect2(data = null) {
        let options = {
            width: '100%',
            placeholder: "Seleziona o crea visita"
        }

        // If data is passed
        if (data) {
            options['data'] = data;
        }

        $('#views').select2(options)
    }

    function initPropertiesSelect2() {
        $('#properties').select2({width:'100%', placeholder:"Seleziona immobile"});
    }

    function createNewView() {
        let data = $('#view-new').serialize()
        $.post('/api/sheets/views', data, function (response) {
            // Let's add the response to the select2
            var view = new Option(response.text, response.id, false, false);
            $('#views').append(view).trigger('change');

            // Add the view to the list
            addViewToList(response)

            // Let's clear the form
            $('textarea[name="note"]').val('');
        })
    }

    $('#client').on('change', function() {
        let $this = $(this)

        if ($this.val() == 'new') {
            // Open form to create client
            $('#client-new').removeClass('d-none')
            return
        }

        // Let's save the client_id
        // and update the view options
        $('#client-new').addClass('d-none')
        $("input[name='client_id']").val($this.val())
        updateViewsOptions($this.val(), function () {
            $('#form').removeClass('d-none')
        })
    })

    $('#views').on('change', function () {
        if ($(this).val() == 'new') {
            return $('#view-new').removeClass('d-none')
        }
        $('#view-new').addClass('d-none')
    })

    $('#add-view').on('click', function () {
        let data = $('#views').select2('data')
        if (data[0].id == 'new') {
            return createNewView()
        }
        addViewToList(data[0])
    })

    $(document).on('click', '.dlt', function (e) {
        e.preventDefault()
        let $parent = $(this).parent().parent()
        let id = $parent.find('input').val()
        $parent.remove()
        $("#views > option[value='" + id + "']").prop('disabled', false)

        // Disable the button if there is no view selected
        if (!$('.view').length) {
            $('#submit-sheet').prop('disabled', true)
        }
    })

    $('#submit-sheet').on('click', function () {
        $('#sheet-new').submit()
    })

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
            $('#form').removeClass('d-none')
        })
    });

    initClientSelect2()
    initViewsSelect2()
    initPropertiesSelect2()
</script>
@stop
