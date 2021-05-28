@extends('estate::layouts.collapsed')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{config('app.url')}}companies">Aziende</a></li>
@stop

@section('css')
<style>
.expandable tr:hover{cursor:pointer;}
</style>
@stop

@include('estate::layouts.elements.title', ['title' => $client->rag_soc])

@section('content')


    <div class="row">


        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card bg-success">
                <div class="card-header">
                    <h3 class="card-title l15">Cliente <span class="badge bg-warning"><a href="{{route('clients.edit', $client->id)}}"><i class="fa fa-edit"></i></a></span></h3>
                    <div class="card-tools">
                        <a href="#" title="scrivi whatsapp" class="btn btn-sm btn-tool"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" title="scrivi email" class="btn btn-sm btn-tool"><i class="fas fa-at"></i></a>
                        <a href="#" title="chiama" class="btn btn-sm btn-tool"><i class="fas fa-phone-alt"></i></a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 firstRowNoBorder">
                            <tbody>
                                <tr>
                                    <td>Nome</td>
                                    <td>{{$client->primary->fullname}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$client->email}}</td>
                                </tr>
                                <tr>
                                    <td>Tel</td>
                                    <td>{{$client->phone}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title l15">Tipo Cliente</h3>
                </div>
                <div class="card-body p-3" style="min-height:90px; height:90px;">
                    {!! Form::select('type', [1=>'Acquirente', 2=>'Venditore', 3=>'Acquirente & Venditore'], $client->type, ['class' => 'custom-select']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title l15">Provenienza</h3>
                </div>
                <div class="card-body" style="min-height:90px; height:90px;"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-3">
            @include('estate::estate.clients.show.other-contacts')
        </div>

        <div class="col-md-6 col-lg-4 col-xl-2">
            @include('estate::estate.clients.show.requests')
        </div>

        <div class="col-md-6 col-lg-4 col-xl-2">
            @include('estate::estate.clients.show.ownerships')
        </div>

        <div class="col-md-6 col-lg-4 col-xl-2">
            @include('estate::estate.clients.show.views')
        </div>

        <div class="col-md-6 col-lg-4 col-xl-2">
            @include('estate::estate.clients.show.sheets')
        </div>

        <div class="col-md-6 col-lg-4 col-xl-2">
            @include('estate::estate.clients.show.offers')
        </div>

        <div class="col-md-6 col-lg-4 col-xl-2">
            @include('estate::estate.clients.show.privacy')
        </div>

    </div>

    @include('estate::estate.clients.show.logs')


{{-- @include('estate::estate.clients.preferences') --}}

@stop

@section('scripts')
{{-- <script src="{{asset('js/global-properties.js')}}"></script> --}}
<script>

let table = $('#table').DataTable(window.tableOptions);

$('a.updateDataTable').on('click', function(e){
    table.search($(this).attr('data-search')).draw();
});



$('#table').on('click', '.logDelete', function(e){
    e.preventDefault();
    let url = $(this).attr('href');
    let row = $(this).parent('td').parent('tr');

    Swal.fire({
        title: 'Siete Sicuri',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sì. elimina!',
        cancelButtonText: 'Annulla.'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(url, {_token:token}).then(response => {
                console.log(response.data);
                if(response.data == 'done')
                {
                    row.remove();
                }
                else
                {
                    err("Errore, non siamo riusciti ad completare l'eliminazione")
                }
            });
        }
    });
});


    $('select[name="type"]').on('change', function(){
        let data = {};
        data._token = token;
        data.field = 'type';
        data.model = 'Company';
        data.id= "{{$client->id}}";
        data.value = $(this).val();
        console.log(data);
        axios.post(baseURL+'update-field', data).then(response => {
            location.reload();
        });
    });

    $('input[name="primary"]').on('change', function(){
        axios.get(baseURL+'contact-switch-primary/'+$(this).attr('data-id')).then(response => {
            location.reload();
        });
    });




</script>

<script>
    $('button.newOffer').on('click', function(e){
        let md = $('#offer-modal');
        $('.modal').css({'background-color':'rgba(0,0,0,.7)'});
        $(md).modal('show');

        $('.btn-save-offer').prop('disabled', true);

        $('#selectPropertiesOffer').select2({width:'100%', placeholder:"Seleziona immobile"});

        $('textarea[name="note"]').on('keyup', function(){

            let offer = false;
            let property = false;

            if($('#selectPropertiesOffer').val() != '')
            {
                property = true;
            }

            if($('input[name="offer"]').val() != '')
            {
                offer = true;
            }

            if(offer && property)
            {
                $('.btn-save-offer').prop('disabled', false);
            }

        });

    });
</script>


@stop
