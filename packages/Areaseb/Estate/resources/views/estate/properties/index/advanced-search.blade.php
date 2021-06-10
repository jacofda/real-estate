{!! Form::open(['url' => route('properties.index'), 'method' => 'get', 'id' => 'formFilter']) !!}
<div class="row" id="advancedSearchBox">


    <div class="col-sm-2">
        <div class="form-group">
            <select class="custom-select" name="city_id">
                @foreach($cities as $id => $city)
                    @if(request('city_id') == $id)
                        <option selected value="{{$id}}">{{$city}}</option>
                    @else
                        <option value="{{$id}}">{{$city}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <select class="custom-select" name="tag_id">
                <option></option>
                @foreach($tags as $id => $tag)
                    @if(request('tag_id') == $id)
                        <option selected="selected" value="{{$id}}">{{$tag}}</option>
                    @else
                        <option value="{{$id}}">{{$tag}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <select class="custom-select" name="contract_id">
                <option></option>
                <option value="2">Affitto</option>
                <option value="1">Vendita</option>
                <option value="3">Affitto & Vendita</option>
            </select>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    {!!Form::text('min_price', request('min_price'), ['class' => 'form-control keys', 'placeholder' => 'Min price'])!!}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {!!Form::text('max_price', request('max_price'), ['class' => 'form-control keys', 'placeholder' => 'Max price'])!!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    {!!Form::text('min_mq', request('min_mq'), ['class' => 'form-control keys', 'placeholder' => 'Min mq'])!!}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {!!Form::text('max_mq', request('max_mq'), ['class' => 'form-control keys', 'placeholder' => 'Max mq'])!!}
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-2">
        <div class="form-group">
            <select class="custom-select" name="floor">
                <option></option>
                <option value="0">Terra</option>
                <option value="1">Primo</option>
                <option value="2">Secondo</option>
                <option value="3">Terzo</option>
            </select>
        </div>
    </div>


    <div class="col-sm-2">
        <div class="form-group">
            {!!Form::select('state',[''=>'']+\Areaseb\Estate\Models\Property::uniqueState(), request('state'))!!}
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <select class="custom-select" name="user_id">
                <option></option>

            </select>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
            <select class="custom-select" name="approved">
                <option></option>
                <option @if(request('approved') == 'null') selected @endif value="null">Da Verificare</option>
                <option @if(request('approved') == '1') selected @endif value="1">Approvati</option>
                <option @if(request('approved') == '0') selected @endif value="0">Scartati</option>
            </select>
        </div>
    </div>



    <div class="col-sm-2 offset-sm-2 text-right" style="float:right">
        <div class="form-group">
            <a class="btn btn-primary" href="{{route('properties.create')}}"><i class="fa fa-plus"></i> Proprietà</a>
        </div>
    </div>

    {{-- <div class="col">
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
    </div> --}}



    @if(request()->input())
        <div class="col">
            <div class="form-group">
                <a href="#" class="btn btn-success btn-sm" id="refresh" style="height:36px; line-height:26px;"><i class="fa fa-redo"></i> Reset</a>
            </div>
        </div>
    @endif



</div>
{!! Form::close() !!}


@push('scripts')
<script>

    $('select[name="city_id"]').select2({placeholder: 'Città', width:'100%'});
    $('select[name="tag_id"]').select2({placeholder: 'Tipologia', width:'100%'});
    $('select[name="contract_id"]').select2({placeholder: 'Contratto', width:'100%',minimumResultsForSearch: -1});
    // $('select[name="sector"]').select2({placeholder: 'Categorie', width:'100%'});
    $('select[name="floor"]').select2({placeholder: 'Piano', width:'100%',minimumResultsForSearch: -1});
    $('select[name="state"]').select2({placeholder: 'Stato', width:'100%',minimumResultsForSearch: -1});
    $('select[name="user_id"]').select2({placeholder: 'Utenti', width:'100%',minimumResultsForSearch: -1});
    $('select[name="approved"]').select2({placeholder: 'Status', width:'100%',minimumResultsForSearch: -1});

    $('select.custom-select').on('change', function(){
        $('#formFilter').submit();
    });


    $('input.keys').on('focusout', function(){
        $('#formFilter').submit();
    });

    $('#refresh').on('click', function(e){
        e.preventDefault();
        let currentUrl = window.location.href;
        let arr = currentUrl.split('?');
        window.location.href = arr[0];
    });


</script>
@endpush
