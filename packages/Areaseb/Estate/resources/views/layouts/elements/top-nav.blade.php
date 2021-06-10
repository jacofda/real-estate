<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
        {!! Form::open(['url' => route('properties.index'), 'method' => 'get']) !!}
            <div class="input-group">
                <input class="form-control" name="search-property" placeholder="proprietà nome o rif" value="{{request('search-property')}}" id="sp">
                <div id="spg" class="input-group-append @if(!request('search-property')) d-none @endif">
                    <button class="btn btn-success"><span class="mr-1" id="spn"></span><i class="fa fa-search"></i></button>
                </div>
            </div>
            <script>
                let isp = document.getElementById('sp');
                isp.addEventListener("keyup", event => {
                    if(isp.value != "")
                    {
                        document.getElementById('spg').classList.remove("d-none");
                        let data = {};
                        data._token = token;
                        data.search = document.getElementById("sp").value;
                        axios.post(baseURL+"api/properties", data).then(response => {
                            console.log(response.data);
                            if(parseInt(response.data) > 0)
                            {
                                document.getElementById('spn').innerText = response.data;
                                document.getElementById('spn').parentElement.disabled= false;
                            }
                            else
                            {
                                document.getElementById('spn').innerText = '';
                                document.getElementById('spn').parentElement.disabled= true;
                            }
                        });

                    }
                    else
                    {
                        document.getElementById('spg').classList.add("d-none");
                    }
                });
            </script>
        {!! Form::close() !!}
    </li>
    <li class="nav-item">
        {!! Form::open(['url' => route('clients.index'), 'method' => 'get']) !!}
            <div class="input-group">
                <input class="form-control" name="search-client" placeholder="cliente" value="{{request('search-client')}}" id="sc">
                <div id="scg" class="input-group-append @if(!request('search-client')) d-none  @endif">
                    <button class="btn btn-success" ><span id="spc" class="mr-1"></span><i class="fa fa-search"></i></button>
                </div>
            </div>

            <script>
                let isc = document.getElementById('sc');
                isc.addEventListener("keyup", event => {
                    if(isc.value != "")
                    {
                        document.getElementById('scg').classList.remove("d-none");
                        let data = {};
                        data._token = token;
                        data.search = document.getElementById("sc").value;
                        axios.post(baseURL+"api/clients", data).then(response => {
                            console.log(response.data);
                            if(parseInt(response.data) > 0)
                            {
                                document.getElementById('spc').innerText = response.data;
                                document.getElementById('spc').parentElement.disabled= false;
                            }
                            else
                            {
                                document.getElementById('spc').innerText = '';
                                document.getElementById('spc').parentElement.disabled= true;
                            }
                        });
                    }
                    else
                    {
                        document.getElementById('scg').classList.add("d-none");
                    }
                });
            </script>

        {!! Form::close() !!}
    </li>
</ul>

<ul class="navbar-nav ml-auto">

    {{-- @include('estate::layouts.elements.notifications') --}}
    <li class="nav-item">
        <a class="nav-link" href="{{route('welcome')}}" title="torna al sito">
            <i class="fas fa-globe"></i>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            {{$user->fullname}}
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="#" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
            @if($user->hasRole('super'))
                <a href="{{url('settings')}}" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
                <a href="#" class="dropdown-item emptyCache"><i class="fas fa-redo-alt"></i> Svuota Cache</a>
            @endif


         </div>
    </li>
  </ul>
</nav>
@push('scripts')
    <script>

        $('a.emptyCache').on('click', function(e){
            e.preventDefault();

            $.post(baseURL+'api/clear-cache', {_token: "{{csrf_token()}}"}).done(function(response){
                new Noty({
                    text: "Svuotamento della cache eseguito",
                    type: 'success',
                    theme: 'bootstrap-v4',
                    timeout: 2500,
                    layout: 'topRight'
                }).show();
            });
        });

    </script>
@endpush
