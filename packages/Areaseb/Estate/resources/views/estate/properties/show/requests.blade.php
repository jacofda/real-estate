{{-- <div class="col-sm-6"> --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Richieste</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button title="aggiungi richiesta" class="btn btn-xxs btn-primary newRequest"><i class="fas fa-plus"></i></button>
                {{-- <a title="aggiungi proprietario" href="#" class="btn btn-tool text-dark addOwner"><i class="fas fa-plus-circle"></i></a> --}}
            </div>
        </div>
        @if(!$requests->isEmpty())
        <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-sm table-striped request-table mb-0 firstRowNoBorder">
                        <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td><i data-id="{{$request->id}}" class="fas fa-chevron-right"></i></td>
                                    @if(\Route::current()->getName() == 'companies.show')
                                        <td>{{$request->property->name_it}}</td>
                                    @else
                                        <td>{{$request->contact->fullname}}</td>
                                    @endif

                                    <td>{{$request->created_at->format('d/m/Y')}}</td>
                                    <td><a href="#" class="btn btn-sm btn-danger removeRequest" data-id="{{$request->id}}"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr class="d-none" id="row-{{$request->id}}">
                                    <td colspan="4">{{$request->note}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

        </div>
        @endif
        {{-- <div class="card-footer p-0">
            <button class="btn btn-sm btn-primary btn-block newRequest">inserisci nuova richiesta</button>
        </div> --}}
    </div>
{{-- </div> --}}

@include('estate::estate.properties.show.request-modal')


@push('scripts')
<script>

$('a.removeRequest').on('click', function(e){
    e.preventDefault();
    let tr = $(this).parent().parent();
    let data = {};
    data._token = token;
    axios.delete(baseURL+'requests/'+$(this).attr('data-id'), data).then((response) => {
        console.log(response.data);
        pass('Richiesta eliminata');
        tr.remove();
    });

})

$('table.request-table').on('click', 'i.fa-chevron-right',function(){
    $('tr#row-'+$(this).attr('data-id')).removeClass('d-none');
    $(this).removeClass('fa-chevron-right').addClass('fa-chevron-down');
})

$('table.request-table').on('click', 'i.fa-chevron-down',function(){
    $('tr#row-'+$(this).attr('data-id')).addClass('d-none');
    $(this).addClass('fa-chevron-right').removeClass('fa-chevron-down');
})


@if( request('contact_id') || request('property_id') )
    $('#createRequest').removeClass('d-none');
    console.log('ciaoo');
@endif

$('button.newRequest').on('click', function(e){
    let md = $('#request-modal');
    $('.modal').css({'background-color':'rgba(0,0,0,.7)'});
    $(md).modal('show');

    $('.btn-save-request').prop('disabled', true);

    $('#selectContactrequest').select2({width:'100%', placeholder:"Seleziona o crea contatto"});

    if($('#selectPropertiesRequest').length)
    {
        $('#selectPropertiesRequest').select2({width:'100%', placeholder:"Seleziona immobile"});
    }

    $('#selectPropertiesRequest').on('change', function(){
        $('input#contact').val($('#selectContactrequest').select2('data')[0].id);
        $('#createContact').addClass('d-none');
        $('select[name="type"]').select2({width:'100%', placeholder: 'Origine contatto'})
        $('#createRequest').removeClass('d-none');
    });

    $('#selectContactrequest').on('change', function(){
        if($(this).select2('data')[0].id == 'new')
        {
            $('#createContact').removeClass('d-none');


            $('input[name="email"]').on('focusout', function(){
                let emailInput = $(this);
                axios.post(baseURL+'request-email-exists', {_token:token, email: emailInput.val()}).then((response) => {
                    console.log(response.data);
                    if(response.data != '0')
                    {
                        emailInput.val('');
                        err('Email già presente nel database, associata ad '+response.data)
                    }
                });
            })

            $('button.saveQuickContact').on('click', function(e){
                e.preventDefault()
                let data = {};
                data._token = token;
                data.nome = $('input[name="nome"]').val();
                data.cognome = $('input[name="cognome"]').val();
                data.email = $('input[name="email"]').val();
                data.mobile = $('input[name="mobile"]').val();
                data.citta = $('input[name="citta"]').val();

                if(data.email == "")
                {
                    return false;
                    err('Email è obbligatoria');
                }


                axios.post(baseURL+'request-create-contact', data).then((response) => {
                    pass('Contatto Aggiunto');
                    $('input#contact').val(response.data);
                    $('select[name="type"]').select2({width:'100%', placeholder: 'Origine contatto'})
                    $('#createRequest').removeClass('d-none');
                    $('#createContact').addClass('d-none');
                });
            });
        }
        else
        {
            $('input#contact').val($(this).select2('data')[0].id);
            $('#createContact').addClass('d-none');
            $('select[name="type"]').select2({width:'100%', placeholder: 'Origine contatto'})
            $('#createRequest').removeClass('d-none');
        }
    });

    $('textarea[name="note"]').on('keyup', function(){

        let type = false;
        let created_at = false;

        if($('select[name="type"]').val() != '')
        {
            type = true;
        }

        if(!$('input[name="created_at"]').val().includes('y'))
        {
            created_at = true;
        }

        if(type && created_at)
        {
            $('.btn-save-request').prop('disabled', false);
        }

    });

    $('button.btn-save-request').on('click', function(){
        let data = {};
        let property_id = '';
        @if(isset($property))
            property_id = "{{$property->id}}";;
        @endif

        if(property_id == '')
        {
            property_id = $('#selectPropertiesRequest').val();
        }


        data._token = token;
        data.type = $('select[name="type"]').val();
        data.created_at = $('input[name="created_at"]').val();
        data.note = $('textarea[name="note"]').val();
        data.contact_id = $('input#contact').val();
        data.property_id = property_id;

        axios.post(baseURL+'requests', data).then((response) => {
            if(response.data == 'done')
            {
                location.reload();
            }
            else
            {
                console.log();
                //err(response.data);
            }
        });

    });

});
</script>
@endpush
