@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Clienti'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div id="app" class="card">
                <div class="card-header bg-secondary-light">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <div class="input-group">
                                    <input v-model="term" type="search" @keyup="search" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{route('clients.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Crea Azienda</a>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    {{-- @include('estate::core.companies.components.advanced-search', ['url_action' => 'companies']) --}}

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped table-php">
                            <thead>
                                <tr>
                                    <th data-field="rag_soc" data-order="asc">Ragione Sociale <i class="fas fa-sort"></i></th>
                                    <th>Contatto</th>
                                    {{-- <th>Preferenze</th> --}}
                                    <th>Tipo</th>
                                    <th>Origine</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    @can('companies.write')
                                        <th data-orderable="false"></th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>

                                <tbody>
                                    <tr v-for="(result,index) in results" class="result">
                                        <td><a v-bind:href="'{{url('clients')}}/' + result.id"> @{{result.rag_soc}} </a> </td>
                                        <td>


                                            {{-- @if($contact) --}}
                                                <span v-if="result.contacts.length > '0'">
                                                    <a v-bind:href="'{{url('contacts')}}/' + result.contacts[0].id + '/edit'" title="modifica contatto" class="badge badge-warning btn-xs"><i class="fa fa-edit"></i></a>
                                                    @{{result.contacts[0].nome}} @{{result.contacts[0].cognome}}
                                                </span>

                                                <span v-if="result.contacts.length === '0'">
                                                    <a v-bind:href="'{{url('contacts/create')}}'" title="crea contatto" class="badge badge-primary btn-xs"><i class="fa fa-plus"></i></a>
                                                </span>

                                                {{-- @if($contact->preference)
                                                    <span style="height:14px;margin-top:6px;" class="badge badge-primary">{{$contact->preference->properties()->count()}}</span>
                                                @endif

                                            @else
                                                <span>
                                                    <a href="{{route('contacts.create')}}" title="aggiungi contatto" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                                </span> --}}
                                            {{-- @endif --}}

                                        </td>
                                        <td>@{{result.type.name}}</td>
                                        <td>@{{result.contacts[0].origin}}</td>
                                        <td>@{{result.email}}</td>
                                        <td>@{{result.phone | international }}</td>
                                        <td>
                                            <a v-bind:href="'{{url('clients')}}/' + result.id + '/edit'" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-edit"></i></a>
                                            <button type="submit" @click="deleteRow(result.id,index)" class="btn btn-danger btn-icon btn-sm"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('scripts')

    {{-- <script src="https://unpkg.com/vue"></script> --}}
    <script src="//unpkg.com/vue@latest/dist/vue.min.js"></script>
    <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
    <script>

    const app = new Vue({
    	el:'#app',
    	data:{
    		term:'',
    		results:{!!$clients!!},
    	},
        filters: {
            international: function(phone){
                if(!phone) return '';
                return '+39'+phone;
            }
        },
    	methods:{
    		search:function() {
    			this.searching = true;
    			fetch(`http://localhost/crm/public/clients?q=${encodeURIComponent(this.term)}`)
    			.then(res => res.json())
    			.then(res => {
    				this.results = res.results;
    			});
    		},
            deleteRow(id, index) {
                Swal.fire({
                  title: 'Siete Sicuri',
                  text: "Questa azione eliminerà tutte le relazioni associate all'azienda e al contatto",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Sì. elimina!',
                  cancelButtonText: 'Annulla!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    axios.delete(baseURL+'clients/'+id, {_token:token}).then(response => this.results.splice(index,1));
                  }
                })
            }
    	}
    });

    </script>









@stop
