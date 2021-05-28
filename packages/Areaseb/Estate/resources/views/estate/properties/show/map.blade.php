@if($property->address)
    <div class="col-sm-4">
        <div id="map" style="height:100%;"></div>
    </div>
@else
    <div class="col-sm-4" style="background:url({{asset('unnamed.jpg')}})"></div>
@endif


@if($property->address)
    @push('scripts')
        <script src="https://maps.googleapis.com/maps/api/js?key={{config('app.map')}}&callback=initMap&libraries=&v=weekly" async></script>
        <script>

            let map;
            let cordsApi = "https://maps.googleapis.com/maps/api/geocode/json?address={{$property->address_api}}&key={{config('app.map')}}";


            let latVal = "{{$property->lat}}";
            let lngVal = "{{$property->lng}}";

            if(latVal == '')
            {
                let data = {};
                axios.get(cordsApi).then(response => {
                    if(response.data.status == 'OK')
                    {
                        latVal = response.data.results[0].geometry.location.lat;
                        lngVal = response.data.results[0].geometry.location.lng;

                        data.field = 'lat';
                        data.value = latVal;
                        data._token = token;
                        data.model = "Property";
                        data.id = "{{$property->id}}";

                        axios.post(baseURL+'update-property-field', data).then(response => {
                            pass('Lat Aggiunta');
                        });


                        data.field = 'lng';
                        data.value = lngVal;
                        data._token = token;
                        data.model = "Property";
                        data.id = "{{$property->id}}";

                        axios.post(baseURL+'update-property-field', data).then(response => {
                            pass('Lng Aggiunta');
                        });


                        function initMap() {
                            map = new google.maps.Map(document.getElementById("map"), {
                                center: new google.maps.LatLng(latVal, lngVal),
                                zoom: 16,
                                mapTypeControl: false,
                            });

                            new google.maps.Marker({
                              position: new google.maps.LatLng(latVal, lngVal),
                              map,
                              title: "{{$property->name_it}}",
                            });

                        }
                    }
                });
            }
            else
            {
                function initMap() {
                    map = new google.maps.Map(document.getElementById("map"), {
                        center: new google.maps.LatLng(latVal, lngVal),
                        zoom: 16,
                        mapTypeControl: false,
                    });

                    new google.maps.Marker({
                      position: new google.maps.LatLng(latVal, lngVal),
                      map,
                      title: "{{$property->name_it}}",
                    });

                }
            }
        </script>
    @endpush
@endif
