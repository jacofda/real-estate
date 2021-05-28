@php
    $hide = $client->requests->isEmpty();
@endphp


<div class="card @if($hide) collapsed-card @endif">
    <div class="card-header bg-Request">
        <h3 class="card-title l15">
            <a title="visualizza richieste" href="#" class="updateDataTable text-dark" data-search="Richiesta"><u>Richieste</u></a>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse"><i class="fas @if($hide) fa-plus @else fa-minus @endif"></i></button>
            <button title="aggiungi richiesta" class="btn btn-xxs btn-primary newRequest"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    @if(!$requests->isEmpty())
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm request-table mb-0 firstRowNoBorder">
                    <tbody>
                        <tr>
                            <td>Tot:{{$requests->count()}}</td>
                        </tr>
                        {{-- @foreach($requests as $request)
                            <tr>
                                <td><i data-id="{{$request->id}}" class="fas fa-chevron-right"></i></td>
                                <td>{{$request->property->name_it}}</td>
                                <td>{{$request->created_at->format('d/m/Y')}}</td>
                                <td><a href="#" class="btn btn-sm btn-danger removeRequest" data-id="{{$request->id}}"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr class="d-none" id="row-{{$request->id}}">
                                <td colspan="4">{{$request->note}}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>


@include('estate::estate.clients.show.request-modal')


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




$('button.newRequest').on('click', function(e){
    let md = $('#request-modal');
    $('.modal').css({'background-color':'rgba(0,0,0,.7)'});
    $(md).modal('show');

    $('.btn-save-request').prop('disabled', true);

    $('#selectPropertiesRequest').select2({width:'100%', placeholder:"Seleziona immobile"});

    $('#selectPropertiesRequest').on('change', function(){
        $('select[name="request_type"]').select2({width:'100%', placeholder: 'Origine richiesta'})
        $('#createRequest').removeClass('d-none');
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
        data._token = token;
        data.type = $('select[name="request_type"]').val();
        data.created_at = $('input[name="created_at"]').val();
        data.note = $('textarea[name="note"]').val();
        data.client_id = "{{$client->id}}";
        data.property_id = $('#selectPropertiesRequest').val();

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
