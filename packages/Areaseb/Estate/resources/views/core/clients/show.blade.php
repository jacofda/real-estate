@extends('estate::layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Clienti</a></li>
@stop

@section('css')
<style>
.expandable tr:hover{cursor:pointer;}
</style>
@stop

@include('estate::layouts.elements.title', ['title' => $client->rag_soc])

@section('content')

    <div class="row">

        <div class="col-md-3">

            <div class="card card-info card-outline">

                <div class="card-header">
                    <h3 class="card-title">{{$client->rag_soc}}</h3>
                    <div class="card-tools">
                        @if($client->type_id)
                            <p class="text-muted text-center mb-0">
                                {{$client->type->name}}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="card-body box-profile">
                    <div class="text-center pb-3">
                        {!!$client->avatar!!}
                    </div>

                    @if($client->contacts()->exists())
                        <div class="table-responsive">
                            <table class="table table-borderless table-sm my-2">
                                <tbody>
                                    @foreach($client->contacts as $c)
                                        <tr>
                                            <td style="background:#00000008;">
                                                <input data-id="{{$c->id}}" type="radio" name="primary" @if($c->primary) checked @endif>
                                            </td>
                                            <td>
                                                <a href="{{$c->url}}">
                                                    {{$c->fullname}}</b><br>
                                                    <small><code style="color:#222">{{$c->email}}</code></small>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @can('companies.write')
                        <a title="modifica azienda" href="{{route('clients.edit', $client->id)}}" class="btn btn-sm btn-warning mb-1"><b><i class="fas fa-edit"></i> Azienda</b></a>
                        <a title="aggiungi contatto" href="{{route('contacts.create')}}?client_id={{$client->id}}" class="btn btn-sm btn-primary mb-1"><b> <i class="fa fa-plus"></i> Contatto</b></a>
                    @endcan
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3">
                            <label style="width:100%;line-height:35px;margin-bottom:0; text-align:center;">Tipo</label>
                        </div>
                        <div class="col-sm-9">
                            {!! Form::select('type', [1=>'Acquirente', 2=>'Venditore', 3=>'Acquirente & Venditore'], $client->type, ['class' => 'custom-select']) !!}
                        </div>
                    </div>

                </div>
            </div>

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Dettagli</h3>
                </div>
                <div class="card-body psmb">
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Indirizzo</strong>
                    <p class="text-muted">{{$client->address}} <br>
                         {{$client->zip}}, {{$client->city}} ({{$client->province}}) {{$client->nation}}
                    </p>
                    <hr>
                    <strong><i class="fas fa-euro-sign mr-1"></i> Fatturazione</strong>
                    @if($client->pec)<p class="text-muted"><b>PEC:</b> {{$client->pec}}</p>@endif
                    @if($client->piva)<p class="text-muted"><b>P.IVA:</b> {{$client->piva}}</p>@endif
                    @if($client->cf)<p class="text-muted"><b>CF:</b> {{$client->cf}}</p>@endif
                    @if($client->sdi)<p class="text-muted"><b>SDI:</b> {{$client->sdi}}</p>@endif
                    <hr>
                    <strong><i class="fas fa-at mr-1"></i> Contatti</strong>
                    @if($client->phone)<p class="text-muted"><b>Tel:</b> {{$client->phone}}</p>@endif
                    @if($client->email)<p class="text-muted"><b>Email:</b> <small>{{$client->email}}</small></p>@endif
                    @if($client->email_ordini)<p class="text-muted"><b>Email Ord.:</b> <small>{{$client->email_ordini}}</small></p>@endif
                    @if($client->email_fatture)<p class="text-muted"><b>Email Fatt.:</b> <small>{{$client->email_fatture}}</small></p>@endif
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Info</a></li>
                        @if($client->events()->exists())
                            <li class="nav-item"><a class="nav-link" href="#eventi" data-toggle="tab">Eventi</a></li>
                        @endif
                        @if($client->contacts()->exists())
                            <li class="nav-item"><a class="nav-link" href="#contatti" data-toggle="tab">Contatti</a></li>
                        @endif
                        @if($client->invoices()->exists())
                            @can('invoices.read')
                                <li class="nav-item"><a class="nav-link" href="#fatture" data-toggle="tab">Fatture</a></li>
                            @endcan
                            @can('products.read')
                                <li class="nav-item"><a class="nav-link" href="#prodotti" data-toggle="tab">Prodotti Venduti</a></li>
                            @endcan
                        @endif

                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="info">
                            @include('estate::core.clients.components.info')
                        </div>
                        <div class="tab-pane" id="contatti">
                            @can('products.read')
                                @include('estate::core.clients.components.contacts')
                            @endcan
                        </div>
                        @if($client->events()->exists())
                            <div class="tab-pane" id="eventi">
                                @include('estate::core.clients.components.events')
                            </div>
                        @endif
                        <div class="tab-pane" id="fatture">
                            @can('invoices.read')
                                @include('estate::core.clients.components.invoices')
                            @endcan
                        </div>
                        <div class="tab-pane" id="prodotti">
                            @can('products.read')
                                @include('estate::core.clients.components.products')
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@stop

@section('scripts')
<script>

    $('input[name="primary"]').on('change', function(){
        axios.get(baseURL+'contact-switch-primary/'+$(this).attr('data-id')).then(response => {
            location.reload();
        });
    });

    $('.nav-pills li a').on('click', function(){
        console.log($(this).attr('href'));
    });
    let currentUrl = window.location.href;
    if(currentUrl.includes('#'))
    {
        let arr = currentUrl.split('#');
        $('a[href="#'+arr[1]+'"]').click();
    }

</script>
@stop
