@php
    $preference = $contact->preference;
    $hideSell = false; $hideRent = false;
    $has_preferences = false;
    if($preference)
    {
        $has_preferences = $preference->has_no_preferences;
    }

@endphp
<div class="col-sm-6">
    <div class="card @if(!$has_preferences) collapsed-card @endif">
        <div class="card-header">
            <h3 class="card-title">Preferenze</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                @if($has_preferences)
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                @else
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <form class="attributes">

                <div class="form-group">
                    <label>Contratto</label><br>

                    <div class="custom-control custom-checkbox" style="display:inline-block; margin-right:5px;">
                        <input class="custom-control-input" type="checkbox" id="customCheckboxV" value="1" name="contract_id"
                            @if($preference)
                                @if(($preference->contract_id == 1) || ($preference->contract_id == 3))
                                    checked
                                    @php $hideRent = true; @endphp
                                @endif
                            @endif
                        >
                        <label style="font-weight:400" for="customCheckboxV" class="custom-control-label">Vendita</label>
                    </div>

                    <div class="custom-control custom-checkbox" style="display:inline-block; margin-right:5px;">
                        <input class="custom-control-input" type="checkbox" id="customCheckboxA" value="2" name="contract_id"
                            @if($preference)
                                @if(($preference->contract_id == 2) || ($preference->contract_id == 3))
                                    checked
                                    @php $hideSell = true; @endphp
                                @endif
                            @endif
                        >
                        <label style="font-weight:400" for="customCheckboxA" class="custom-control-label">Affitto</label>
                    </div>


                </div>

                <div class="form-group">
                    <label>Aree</label><br>
                    @foreach(\Areaseb\Estate\Models\Property::realCitiesChunked() as $chunk)

                        <div class="row">

                            @foreach($chunk as $id => $comune)
                                @php $rc = rand(0,4000) @endphp
                                <div class="col-sm-6 col-xl-4">
                                    <div class="custom-control custom-checkbox" style="display:inline-block; margin-right:5px;">
                                        <input class="custom-control-input" type="checkbox" id="customCheckboxC{{$rc}}" value="{{$id}}" name="city_id"
                                        @if($preference)
                                            @if($preference->hasCity($id))
                                                checked
                                            @endif
                                        @endif
                                        >
                                        <label style="font-weight:400" for="customCheckboxC{{$rc}}" class="custom-control-label"><small>{{$comune}}</small></label>
                                    </div>
                                </div>

                            @endforeach
                        </div>


                    @endforeach
                </div>


                <div class="form-group">
                    <label>Tipologie</label><br>
                    @foreach(\Areaseb\Estate\Models\Property::realTagsChunked() as $chunk)

                        <div class="row">

                            @foreach($chunk as $id => $tag)
                                @php $rt = rand(4001,8000) @endphp
                                <div class="col">
                                    <div class="custom-control custom-checkbox" style="display:inline-block; margin-right:5px;">
                                        <input class="custom-control-input" type="checkbox" id="customCheckboxT{{$rt}}" value="{{$id}}" name="tag_id"
                                        @if($preference)
                                            @if($preference->hasTag($id))
                                                checked
                                            @endif
                                        @endif
                                        >
                                        <label style="font-weight:400" for="customCheckboxT{{$rt}}" class="custom-control-label"><small>{{$tag}}</small></label>
                                    </div>
                                </div>

                            @endforeach

                        </div>


                    @endforeach
                </div>


                <div class="form-group pSell @if($hideSell) d-none @endif">
                    <label>Prezzo Vendita</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="sell_price_from" placeholder="da prezzo" value="{{$preference ? $preference->sell_price_from : null}}">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="sell_price_to" placeholder="a prezzo" value="{{$preference ? $preference->sell_price_to : null}}">
                        </div>
                    </div>
                </div>

                <div class="form-group pRent @if($hideRent) d-none @endif">
                    <label>Prezzo Affitto</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="rent_price_from" placeholder="da prezzo" value="{{$preference ? $preference->rent_price_from : null}}">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="rent_price_to" placeholder="a prezzo" value="{{$preference ? $preference->rent_price_to : null}}">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label>Mq immobile</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="surface_from" placeholder="da mq" value="{{$preference ? $preference->surface_from : null}}">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="surface_to" placeholder="a mq" value="{{$preference ? $preference->surface_to : null}}">
                        </div>
                    </div>
                </div>



            </form>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col" style="line-height:35px;">
                    <b>Immobili:</b> <span>{{$preference ? $preference->properties()->count() : \Areaseb\Estate\Models\Property::count()}}</span>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="card" id="offers">
        @if($has_preferences)
            @include('estate::estate.clients.offers')
        @endif
    </div>
</div>

@push('scripts')
<script>

    let myTableOptions = {
        aaSorting: [],
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        bLengthChange: false,
        language: {
            search: '_INPUT_',
            searchPlaceholder: 'Scrivi per filtrare...',
            lengthMenu: '_MENU_',
            info: "",
            zeroRecords: "Non ci sono dati",
            infoEmpty: "Non ci sono dati",
            paginate: {
                first:      "Primo",
                previous:   "<",
                next:       ">",
                last:       "Ultimo"
            },
        }
    };

    $('#table').dataTable(myTableOptions);

    function arrayRemove(arr, value) {
       return arr.filter(function(ele){
           return ele != value;
       });
    }


   $('#customCheckboxV').on('click', function(){
       $('.pRent').toggleClass('d-none');
   });

   $('#customCheckboxA').on('click', function(){
       $('.pSell').toggleClass('d-none');
   });

    @if($preference)

        let attributes = [];

        $.each($('form.attributes input'), function(){

            let search = {};
            search.name = $(this).attr('name');

            if($(this).attr('type') == 'checkbox')
            {
                if($(this).is(':checked'))
                {
                    search.value = parseInt($(this).val());
                    attributes.push(search);
                }
            }

            if($(this).attr('type') == 'text')
            {
                if( $(this).val() != '')
                {
                    search.value = parseFloat($(this).val());
                    attributes.push(search);
                }
            }
        });


    @else
        let attributes = [];
    @endif


    $('form input').on('change', function(){
        let search = {};

        search.name = $(this).attr('name');

        if($(this).attr('type') == 'checkbox')
        {
            search.value = parseInt($(this).val());

            if($(this).is(':checked'))
            {
                attributes.push(search);
            }
            else
            {
                for( var i = 0; i < attributes.length; i++){
                    if( (attributes[i].name == search.name) && (attributes[i].value == search.value)){
                        attributes.splice(i, 1);
                    }
                }
            }
        }

        if($(this).attr('type') == 'text')
        {
            for( var i = 0; i < attributes.length; i++){
                if( attributes[i].name == search.name){
                    attributes.splice(i, 1);
                }
            }

            if( $(this).val() != '')
            {
                search.value = parseFloat($(this).val());
                attributes.push(search);
            }
        }


        let data = {};
        data._token = token;
        data.data = attributes;
        data.contact_id = "{{$contact->id}}";

        axios.post(baseURL+'api/properties-filter', data).then((response) => {
            console.log(response.data)
            $('.card-footer span').html(response.data.results.length);

            if(response.data.results.length)
            {
                axios.get(baseURL+'api/properties-filter/'+"{{$contact->id}}").then((response) => {
                    $('#offers').html(response.data);
                    $('#table').dataTable(myTableOptions);
                });
            }

        });

    });
</script>
@endpush
