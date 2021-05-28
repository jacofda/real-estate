{!! Form::open(['url' => url($url_action), 'method' => 'get', 'id' => 'formFilter']) !!}
@if(request()->input())
    @if(request()->has('id'))
        <div class="row d-none" id="advancedSearchBox">
    @else
        <div class="row" id="advancedSearchBox">
    @endif
@else
    <div class="row d-none" id="advancedSearchBox">
@endif


    @if(request()->input())
        <div style="float: left;width:87px;">
            <div class="form-group">
                <a href="#" class="btn btn-success btn-sm" id="refresh" style="height:36px; line-height:26px;"><i class="fa fa-redo"></i> Reset</a>
            </div>
        </div>
    @endif

    <div class="col">
        <div class="form-group">
            <select class="custom-select" name="region">
                @foreach(Areaseb\Estate\Models\City::uniqueRegions() as $region)
                    @if(request('region') == $region)
                        <option selected>{{$region}}</option>
                    @else
                        <option>{{$region}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <select class="custom-select" name="province">
                @foreach(Areaseb\Estate\Models\City::uniqueProvinces(request('region')) as $province)
                    @if(request('province') == $province)
                        <option selected>{{$province}}</option>
                    @else
                        <option>{{$province}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <select class="custom-select" name="tipo">
                <option></option>
                @foreach(Areaseb\Estate\Models\ClientType::all() as $tipo)
                    @if(request('tipo') == $tipo->id)
                        <option selected="selected" value="{{$tipo->id}}">{{$tipo->name}}</option>
                    @else
                        <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <select class="custom-select" name="sector">
                <option></option>
                @foreach(Areaseb\Estate\Models\Sector::pluck('nome', 'id')->toArray() as $id => $nome)
                    @if(request('sector') == $id)
                        <option selected="selected" value="{{$id}}">{{$nome}}</option>
                    @else
                        <option value="{{$id}}">{{$nome}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <select class="custom-select" name="supplier">
                <option></option>
                    @if(request('supplier') == "1")
                        <option selected="selected" value="1">Sì</option>
                        <option value="0">No</option>
                    @elseif(request('supplier') == "0")
                        <option value="1">Sì</option>
                        <option selected="selected" value="0">No</option>
                    @else
                        <option value="1">Sì</option>
                        <option value="0">No</option>
                    @endif

            </select>
        </div>
    </div>

    <div class="col col-xl-2">
        <div class="form-group">
            <a style="height:38px; line-height:28px;" href="#" title="crea contatti da selezione" class="btn btn-success btn-sm creaContatti"><i class="fa fa-plus"></i> Crea Contatti</a>
        </div>
    </div>


</div>
{!! Form::close() !!}


@push('scripts')
<script>
    $('#customSwitch1').on('change', function(){
        if($(this).prop('checked') === true)
        {
            $('#advancedSearchBox').removeClass('d-none');
        }
        else
        {
            $('#advancedSearchBox').addClass('d-none');
        }
    });

    $('select[name="region"]').select2({placeholder: 'Regione', width:'100%'});
    $('select[name="province"]').select2({placeholder: 'Provincia', width:'100%'});
    $('select[name="tipo"]').select2({placeholder: 'Tipo contatto', width:'100%'});
    $('select[name="sector"]').select2({placeholder: 'Categorie', width:'100%'});
    $('select[name="supplier"]').select2({placeholder: 'Fornitore', width:'100%'});

    $('select.custom-select').on('change', function(){
        $('#formFilter').submit();
    });

    $('#refresh').on('click', function(e){
        e.preventDefault();
        let currentUrl = window.location.href;
        let arr = currentUrl.split('?');
        window.location.href = arr[0];
    });

    $('a.creaContatti').on('click', function(e){
        e.preventDefault();


        let data = {};
        data.region = ($('select[name="region"]').val() == "") ? null : $('select[name="region"]').val();
        data.province = ($('select[name="province"]').val() == "") ? null : $('select[name="province"]').val();
        data.tipo = ($('select[name="tipo"]').val() == "") ? null : $('select[name="tipo"]').val();
        data.sector = ($('select[name="sector"]').val() == "") ? null : $('select[name="sector"]').val();
        data.fornitore = ($('select[name="fornitore"]').val() == "") ? null : $('select[name="fornitore"]').val();
        data._token = token;


        $.post( "{{url('api/companies/create-contacts')}}", data, function(response){
            new Noty({
                text: response,
                type: 'success',
                theme: 'bootstrap-v4',
                timeout: 2500,
                layout: 'topRight'
            }).show();
        });

    });

</script>
@endpush
