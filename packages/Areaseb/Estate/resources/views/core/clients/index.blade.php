@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Clienti'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary-light">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group ta">
                                <input style="width:100%" id="autoComplete" type="text" tabindex="1">@if(request()->has('id'))<a title="reset" href="{{url('companies')}}" class="btn btn-danger reset"><i class="fas fa-times"></i></a>@endif
                        		<div class="selection"></div>
                            </div>
                        </div>
                        <div class="col-6 text-right">

                            <div class="card-tools">

                                <div class="btn-group" role="group">
                                    <div class="form-group mr-3 mb-0 mt-2">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" @if(request()->input() && !request()->has('id')) checked @endif>
                                            <label class="custom-control-label" for="customSwitch1">Ricerca Avanzata</label>
                                        </div>
                                    </div>

                                    @can('companies.read')

                                        <div class="btn-group" role="group">
                                            <button id="create" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" data-display="static" aria-expanded="false">
                                                CSV
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" title="esporta aziende da csv" href="{{url('exports/companies/'. str_replace(request()->url(), '',request()->fullUrl()))}}"><i class="fas fa-download"></i> Esporta in csv</a>
                                                @can('companies.write') <a class="dropdown-item" title="importa aziende da csv" href="{{url('imports/companies')}}"><i class="fas fa-upload"></i> Importa da csv</a> @endcan
                                            </div>
                                        </div>
                                        <a class="btn btn-primary" href="{{route('companies.create')}}"><i class="fas fa-plus"></i> Crea Azienda</a>

                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    @include('estate::core.companies.components.advanced-search', ['url_action' => 'companies'])

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped table-php">
                            <thead>
                                <tr>
                                    <th data-field="rag_soc" data-order="asc">Ragione Sociale <i class="fas fa-sort"></i></th>
                                    <th>Contatto</th>
                                    {{-- <th>Preferenze</th> --}}
                                    <th>Tipo</th>
                                    <th>Origine</th>
                                    <th>P.IVA</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    @can('companies.write')
                                        <th data-orderable="false"></th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)

                                    @php
                                        $contact = $client->contacts()->with('preference')->first();
                                    @endphp

                                    <tr id="row-{{$client->id}}" {{$client->new_from_site}}>
                                        <td><a class="defaultColor" href="{{$client->url}}">{{$client->rag_soc}}</a></td>
                                        <td class="d-flex justify-content-between" style="border:none;line-height:1.8rem;">
                                            @if($contact)
                                                <span>
                                                    <a href="{{route('contacts.edit', $contact->id)}}" title="modifica contatto" class="badge badge-warning btn-xs"><i class="fa fa-edit"></i></a>
                                                    {{$contact->fullname}}
                                                </span>

                                                @if($contact->preference)
                                                    <span style="height:14px;margin-top:6px;" class="badge badge-primary">{{$contact->preference->properties()->count()}}</span>
                                                @endif

                                            @else
                                                <span>
                                                    <a href="{{route('contacts.create')}}" title="aggiungi contatto" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                                </span>
                                            @endif

                                        </td>
                                        <td>
                                            <small>
                                                @foreach($client->clients as $type)
                                                    @if($loop->last)
                                                        {{$type->nome}}
                                                    @else
                                                        {{$type->nome}},
                                                    @endif
                                                @endforeach
                                            </small>
                                        </td>
                                        <td>
                                            {{$contact->origin}}
                                        </td>
                                        <td>
                                            <small>
                                                {{$client->piva}}
                                            </small>
                                        </td>
                                        <td>
                                            <small>
                                                {{$client->email}}
                                            </small>
                                        </td>
                                        <td>
                                            <small>
                                                @if($client->phone)
                                                    @if($client->nation != "" || !is_null($client->nation))
                                                        @if($client->nazione == 'IT')
                                                            +39{{$client->telefono}}
                                                        @else
                                                            @php
                                                            $prefix = '';
                                                            $c = \Areaseb\Estate\Models\Country::where('iso2', $client->nation)->first();
                                                            if($c)
                                                            {
                                                                $prefix = "+".$c->phone_code;
                                                            }
                                                            @endphp
                                                            {{$prefix.$client->phone}}
                                                        @endif
                                                    @else
                                                        {{$client->phone}}
                                                    @endif
                                                @endif
                                            </small>
                                        </td>
                                        @can('companies.write')
                                            <td class="pl-2">
                                                {!! Form::open(['method' => 'delete', 'url' => $client->url, 'id' => "form-".$client->id]) !!}
                                                    <a href="{{$client->url}}/edit" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-edit"></i></a>

                                                    @can('companies.delete')
                                                        <button type="submit" id="{{$client->id}}" class="btn btn-danger btn-icon btn-sm delete"><i class="fa fa-trash"></i></button>
                                                    @endcan

                                                    @includeIf('deals::quick-btn.link-company')
                                                    @includeIf('killerquote::quick-btn.link-company')

                                                {!! Form::close() !!}
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">
                    <p class="text-left text-muted">{{$clients->count()}} of {{ $clients->total() }} aziende</p>
                    {{ $clients->appends(request()->input())->links() }}
                </div>

            </div>
        </div>
    </div>
@stop

@section('scripts')



    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@7.2.0/dist/js/autoComplete.min.js"></script>

<script>

const autoCompletejs = new autoComplete({
	data: {
		src: async () => {
			document.querySelector("#autoComplete").setAttribute("placeholder", "Loading...");
			const source = await fetch(
				"{{url('api/ta/companies')}}"
			);
			const data = await source.json();
			document.querySelector("#autoComplete").setAttribute("placeholder", "Cerca Aziende");
			return data;
		},
		key: ["name"],
		cache: false
	},
	sort: (a, b) => {
		if (a.match < b.match) return -1;
		if (a.match > b.match) return 1;
		return 0;
	},
	placeHolder: "Cerca Aziende",
	selector: "#autoComplete",
	threshold: 2,
	debounce: 0,
	searchEngine: "strict",
	highlight: true,
	maxResults: 5,
	resultsList: {
		render: true,
		container: (source) => {
			source.setAttribute("id", "autoComplete_list");
		},
		destination: document.querySelector("#autoComplete"),
		position: "afterend",
		element: "ul"
	},
	resultItem: {
		content: (data, source) => {
			source.innerHTML = data.match;
		},
		element: "li"
	},
	noResults: () => {
		const result = document.createElement("li");
		result.setAttribute("class", "no_result");
		result.setAttribute("tabindex", "1");
		result.innerHTML = "No Results";
		document.querySelector("#autoComplete_list").appendChild(result);
	},
	onSelection: (feedback) => {
		const selection = feedback.selection.value.name;
		document.querySelector("#autoComplete").value = "";
		document.querySelector("#autoComplete").setAttribute("placeholder", selection);
		console.log(feedback);
        window.location.href = "{{url('companies?id=')}}"+feedback.selection.value.id;
	}
});
</script>









@stop
