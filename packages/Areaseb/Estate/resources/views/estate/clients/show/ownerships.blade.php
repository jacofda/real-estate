@php
    $hide = $client->ownerships->isEmpty();
@endphp


<div class="card @if($hide) collapsed-card @endif">
    <div class="card-header bg-Ownership">
        <h3 class="card-title l15">
            <a title="visualizza richieste" href="#" class="updateDataTable text-white" data-search="Proprietà"><u>Proprietà</u></a>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse"><i class="fas @if($hide) fa-plus @else fa-minus @endif"></i></button>
            <button title="aggiungi proprietà" class="btn btn-xxs btn-primary newProperty"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    @if( !$client->ownerships->isEmpty() )
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0 firstRowNoBorder">
                    <tbody>
                        <tr>
                            <td>Tot: {{$client->ownerships->count()}}</td>
                        </tr>
                        {{-- @foreach($client->ownerships as $ownership)
                            <tr>
                                <td colspan="2">{{$ownership->property->name_it}}</td>
                            </tr>
                            <tr>
                                <td style="border-top:none;">dal {{$ownership->from->format('d/m/Y')}}</td>
                                <td style="border-top:none;">
                                    <a href="#" data-id="{{$ownership->id}}" class="btn btn-danger btn-xs deleteOwnership"><i class="fa fa-trash"></i></a>
                                    <a href="{{route('ownerships.show', $ownership->id)}}" data-id="{{$ownership->id}}" class="btn btn-warning btn-xs" title="dettagli propietà"><i class="fa fa-plus"></i></a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

@include('estate::estate.clients.show.ownership-modal')


@push('scripts')

    <script>



    $('button.newProperty').on('click', function(e){
        let md = $('#ownership-modal');
        $('.modal').css({'background-color':'rgba(0,0,0,.7)'});
        $(md).modal('show');

        $('.btn-save-ownership').prop('disabled', true);
        Inputmask().mask("input");
        $('select#selectPropertiesOwnership').select2({placeholder:'Seleziona immobile', width:'100%'});


        $('input[name="from"]').on('keyup', function(){
            if(!$(this).val().includes('y'))
            {
                $('.btn-save-ownership').prop("disabled", false);
            }
            else
            {
                $('.btn-save-ownership').prop("disabled", true);
            }
        });


        $('button.btn-save-ownership').on('click', function(){
            let url = "{{route('properties.add.property', $client->id)}}"
            let data = {};
            data._token = token;

            data.from = $('input[name="from"]').val();
            data.property_id = $('#selectPropertiesOwnership').val();

            axios.post(url, data).then((response) => {
                if(response.data == 'done')
                {
                    location.reload();
                }
                else
                {
                    console.log();
                }
            });

        });


    });









        $('a.deleteOwnership').on('click', function(e){
            e.preventDefault();

            let el = $(this).parent('td').parent('tr');
            let ownership_id = $(this).attr('data-id');

            Swal.fire(s2Warning).then((result) => {
                if (result.value) {
                    el.remove();
                    axios.post(baseURL+'properties/'+ownership_id+'/delete-ownership', {_token:token}).then((response) => {
                        pass('Propietario eliminato');
                    });
                }
            });
        });

        $('button.newProperty').on('click', function(e){
            $('#ownerForm').removeClass('d-none');
        });

    </script>
@endpush
