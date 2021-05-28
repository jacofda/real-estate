<div class="col-md-6">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Nominativo</h3>
        </div>
        <div class="card-body">

            <div class="form-group">
                <label>Ragione Sociale</label>
                <div class="input-group">
                    {!! Form::text('rag_soc', null, ['class' => 'form-control', 'required']) !!}
                    @if(!isset($client))
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <input id="create-contact" type="checkbox" checked> &nbsp;<small>crea contatto</small>
                            </div>
                        </div>
                    @endif
                </div>
                @include('estate::components.add-invalid', ['element' => 'rag_soc'])
            </div>

            <div class="row" id="insertCreateContact">

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nazione</label>
                        {!! Form::select('nation', $countries, null, ['class' => 'custom-select', 'id' => 'country']) !!}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Indirizzo</label>
                        {!!Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Indirizzo'])!!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Città</label>
                {!!Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'Città'])!!}
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>CAP</label>
                        {!!Form::text('zip', null, ['class' => 'form-control', 'placeholder' => 'CAP'])!!}
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label>Provincia</label>

                        {!!Form::text('province', null, [
                            'class' => 'form-control',
                            'placeholder' =>'Regione Estera',
                            'id' => 'region'])!!}

                        {!! Form::select('province', $provinces, null, [
                            'class' => 'form-control select2bs4',
                            'data-placeholder' => 'Seleziona una provincia',
                            'style' => 'width:100%',
                            'id' => 'provincia']) !!}
                        </div>

                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                {!!Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Indirizzo Email', 'required', 'autocomplete' => 'off', 'data-type' => 'email'])!!}
                @include('estate::components.add-invalid', ['element' => 'email'])
            </div>


            <div class="form-group">
                <label>Telefono</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="changePrefix"></span>
                    </div>
                    {!!Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Telefono'])!!}
                </div>
            </div>


        </div>
    </div>
    @isset($client)
    <div class="card card-outline card-primary">

        <div class="card-body pt-0">

                <div class="direct-chat-messages allNotes" style="height:auto">
                    @if(!is_null($client->note))
                        @foreach($client->note as $key => $n)
                            <div class="direct-chat-msg" id="wrapNote-{{$key}}">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">{{$n['user']}}</span>
                                    <span class="direct-chat-timestamp float-right">{{$n['data']}} <a href="#" data-key="{{$key}}" class="text-danger deleteNote"><i class="fas fa-trash"></i></a> <a href="#" data-key="{{$key}}" class="text-success editNote"><i class="fas fa-edit"></i></a></span>
                                </div>
                                <div class="direct-chat-text" style="margin-left:0;" id="note-{{$key}}">
                                    {{$n['note']}}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>


            <div class="input-group">
                <input class="form-control" name="note" type="text" value="" placeholder="Aggiungi nota">
                <div class="input-group-append">
                    <span class="input-group-text addNote bg-primary"><i class="fas fa-plus"></i></span>
                </div>
            </div>

        </div>
    </div>
    @endisset


</div>

<div class="col-md-6">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Fatturazione</h3>
        </div>
        <div class="card-body pb-0">

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Privato</label>
                        {!!Form::select('private', [0 => 'No', 1 => 'Si'], null, ['class' => 'custom-select'])!!}
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label>SDI</label>
                        {!!Form::text('sdi', null, ['class' => 'form-control', 'placeholder' => 'Identificativo e-fattura', 'maxlength' => '7'])!!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>PEC</label>
                {!!Form::text('pec', null, ['class' => 'form-control', 'placeholder' => 'PEC', 'data-type' => 'email'])!!}
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>P.IVA</label>
                        {!!Form::text('piva', null, ['class' => 'form-control', 'placeholder' => 'Partita iva'])!!}
                        @include('estate::components.add-invalid', ['element' => 'piva'])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>CF</label>
                        {!!Form::text('cf', null, ['class' => 'form-control', 'placeholder' => 'Codice fiscale'])!!}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="card card-outline card-warning">
        <div class="card-header">
            <h3 class="card-title">Tipologia</h3>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Tipo</label>
                        {!! Form::select('type_id', [1=>'Lead', 2=>'Prospect', 3=>'Client'] , null, [
                            'class' => 'form-control select2bs4 tipologia',
                            'multiple' => 'multiple',
                            'data-placeholder' => 'Seleziona una tipologia di cliente',
                            'style' => 'width:100%',
                            'required']) !!}
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>Categoria</label>
                        {!!Form::select('sector_id', $sectors, null, ['class' => 'form-control add-select'])!!}
                        <p class="text-muted"><small>Scrivi per creare una nuova categoria</small></p>
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

@if(!isset($client))

    const toggleCreateContact = (bool) => {

        let html = `
            <div class="col-md-4">
                <div class="form-group">
                    <input class="form-control" placeholder="Nome (obbligatorio)" name="nome" type="text" required>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <input class="form-control" placeholder="Cognome (obbligatorio)" name="cognome" type="text" required>
                </div>
            </div>
        `;

        if(bool)
        {
            $('#insertCreateContact').html(html);
        }
        else
        {
            $('#insertCreateContact').html('');
        }
    }


    toggleCreateContact($('input#create-contact').is(":checked"))

    $('input#create-contact').on('change', function(){
        toggleCreateContact($('input#create-contact').is(":checked"))
    });

@endif



@isset($client)

let notes = [];

$.get("{{route('api.client.notes', $client->id)}}", function(response){
    if(response)
    {
        notes = response;
    }
});


$('.addNote').on('click', function(){
    let note = {
        "data": moment().format('DD/M/Y H:mm'),
        "user": "{{$user->contact->fullname}}",
        "note": $(this).parent('div').siblings('input').val()
    };
    notes.push(note);
    addNoteHtml(note);
    $(this).parent('div').siblings('input').val('');

    $.post("{{route('api.client.addNotes', $client->id)}}", {_token: token, obj: notes}).done(function( data ) {
        location.reload();
    });

});

function addNoteHtml(note)
{
    let html = '<div class="direct-chat-msg"><div class="direct-chat-infos clearfix"><span class="direct-chat-name float-left">'+note.user+'</span><span class="direct-chat-timestamp float-right">'+note.data+'</span></div><div class="direct-chat-text" style="margin-left:0;">'+note.note+'</div></div>';
    $('.allNotes').append(html);
}

$('.allNotes').on('click', 'a.deleteNote', function(e){
    e.preventDefault();
    let key = $(this).attr('data-key');
    let newNotes = [];
    for(var k in notes)
    {
        if(k != key)
        {
            newNotes.push(notes[k]);
        }
    }

    $('#wrapNote-'+key).remove();

    $.post("{{route('api.client.addNotes', $client->id)}}", {_token: token, obj: newNotes}).done(function( data ) {
        console.log(data);
    });
});

$('.allNotes').on('click', 'a.editNote', function(e){
    e.preventDefault();
    let key = $(this).attr('data-key');
    let text = $('#note-'+key).text().trim();
    $('input[name="note"]').val(text);
    let newNotes = [];
    for(var k in notes)
    {
        if(k != key)
        {
            newNotes.push(notes[k]);
        }
    }
    $('#wrapNote-'+key).remove();
    $.post("{{route('api.client.addNotes', $client->id)}}", {_token: token, obj: newNotes}).done(function( data ) {
        console.log(data);
    });
})

@endisset

    $('.add-select').select2({tags: true, placeholder: 'Associa spesa ad una categoria'});
    $('select[name="exemption_id"]').select2({placeholder: 'Esenzione di default preimpostata', allowClear:true});
    $('select[name="pagamento"]').select2({placeholder: 'Metodo Pagamento', allowClear:true});

    $('input[name="city"').on('focusout', function(){
        $.post("{{route('api.city.zip')}}", {_token: token, citta: $(this).val()}).done(function( data ) {
            $('input[name="zip"]').val(data.cap);
            $('select[name="province"]').val(data.provincia);
            $('select[name="province"]').trigger('change');
        });
    });

    function prefix()
    {
        $.post("{{url('api/countries')}}", {
            _token: token,
            iso: $('select#country').find(':selected').val()
        }).done(function(data){
            if(data !== null)
            {
                $('span#changePrefix').text('+'+data);
                if(data != '39')
                {
                    $('select#provincia').select2('destroy').hide();
                    $('input#region').show();
                    if($('input[name="sdi"]').val() == '')
                    {
                        $('input[name="sdi"]').val('XXXXXXX');
                    }
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

    // function adjustFatturazione()
    // {
    //     let pec = $('input[name="pec"]');
    //     let pec = $('input[name="pec"]');
    // }
    //
    // adjustFatturazione()
    //
    // $('select[name="privato"]').on('change', function(){
    //     adjustFatturazione();
    // });

    let selection = $('select.tipologia').select2("data");
    isReferente(selection);

    function isReferente(selection)
    {
        selection = $('select.tipologia').select2("data");
        let check = 0
        $.each(selection, function(i,v){
            if(v.text == 'Referente')
            {
                check++;
            }
        });
        if(check > 0)
        {
            $('div#parentSelect').removeClass('d-none');
        }
        else
        {
            $('div#parentSelect').addClass('d-none');
        }
    }

    $('select.tipologia').on('change', function(e){
        let selection = $(this).select2("data");
        isReferente(selection);
    });

    $('input[name="piva"]').on('focusout', function(){
        $('input[name="cf"]').val($(this).val());
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

        $('form#clientForm').submit();
    });

    @if(request()->has('q'))

        let field = "{{request()->get('q')}}";
        $('input[name="'+field+'"]').addClass('is-invalid');
        err("Compila i campi obbligatori prima di inviare la fattura")

    @endif

</script>
@stop
