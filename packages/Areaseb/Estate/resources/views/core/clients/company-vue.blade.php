@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Aziende'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div id="app" class="card">
                <div class="card-header bg-secondary-light">

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input v-model="term" type="search" class="form-control">
                    			<button class="btn btn-success" @click="search">Search</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped table-php">
                            <thead>
                                <tr>
                                    <th>Ragione Sociale</th>
                                    <th>Tipo</th>
                                    <th>Settore</th>
                                    <th>P.IVA</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    @can('companies.write')
                                        <th data-orderable="false"></th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="result in results" class="result">
                                    <td>@{{result.rag_soc}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>@{{result.email}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer text-center">

                </div>

            </div>
        </div>
    </div>
@stop

@section('scripts')


<script src="https://unpkg.com/vue"></script>
<script src="{{asset('vue/company-vue.js')}}"></script>






@stop
