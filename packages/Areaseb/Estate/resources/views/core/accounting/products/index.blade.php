@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Prodotti'])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary-light">
                    <h3 class="card-title">Prodotti</h3>
                    <div class="card-tools">
                        @can('products.write')
                            <a class="btn btn-primary btn-sm" href="{{url('products/create')}}"><i class="fas fa-plus"></i> Crea Prodotto</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">

                    {!! Form::open(['url' => url('products'), 'method' => 'get', 'id' => 'formFilter']) !!}
                        <div class="row" id="advancedSearchBox">


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="select2" name="category_id">
                                        <option></option>
                                        @foreach($categories as $category)
                                            @if(request('category_id') == $category->id)
                                                <option value="{{$category->id}}" selected>{{$category->nome}}</option>
                                            @else
                                                <option value="{{$category->id}}">{{$category->nome}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="ricerca per nome prodotto o codice" name="search" value="{{request('search')}}">
                                        <div class="input-group-append" id="button-addon4">
                                            <button class="btn btn-success" type="submit"><i class="fas fa-search"></i> Cerca</button>
                                            @if(request()->query())
                                                <a href="{{url('products')}}" title="resetta form di ricerca" class="btn btn-danger"><i class="fas fa-times"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    {{Form::close()}}
                    <div class="table-responsive">
                        <table id="table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Categorie</th>
                                    <th>Codice</th>
                                    <th>Nome</th>
                                    <th>Descrizione</th>
                                    <th style="width:86px;">Prezzo</th>
                                    <th>Iva</th>
                                    <th style="width:63px;">P. Ivato</th>
                                    @if(\Areaseb\Estate\Models\Product::hasRecursiveProducts())<th>Ricursivo</th>@endif
                                    @can('products.write')
                                        <th></th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr id="row-{{$product->id}}">
                                        <td>
                                            <small>
                                                @foreach($product->categories as $category)
                                                    @if($loop->last)
                                                        {{$category->nome}}
                                                    @else
                                                        {{$category->nome}},
                                                    @endif
                                                @endforeach
                                            </small>
                                        </td>
                                        <td>
                                            <small>{{$product->codice}}</small>
                                        </td>
                                        <td>
                                            <small>{{$product->nome}}</small>
                                        </td>
                                        <td>
                                            <small>{{$product->descrizione}}</small>
                                        </td>
                                        <td>
                                            € {{number_format($product->prezzo, '5', ',', '.')}}
                                        </td>
                                        <td>
                                            {{$product->perc_iva}}%
                                        </td>
                                        <td>
                                            € {{number_format( (1 + ($product->perc_iva/100)) * $product->prezzo, '2', ',', '.')}}
                                        </td>
                                        @if(\Areaseb\Estate\Models\Product::hasRecursiveProducts())
                                            <td>
                                                @if($product->periodo)
                                                    {{$product->text_period}}
                                                @endif
                                            </td>
                                        @endif
                                        @can('products.write')
                                            <td class="pl-2">
                                                {!! Form::open(['method' => 'delete', 'url' => $product->url, 'id' => "form-".$product->id]) !!}
                                                    <a href="{{$product->url}}/edit" class="btn btn-warning btn-icon btn-sm"><i class="fa fa-edit"></i></a>
                                                    <a href="{{$product->url}}/media" title="aggiungi media" class="btn btn-info btn-icon btn-sm"><i class="fa fa-image"></i></a>
                                                    @can('products.delete')
                                                        <button type="submit" id="{{$product->id}}" class="btn btn-danger btn-icon btn-sm delete"><i class="fa fa-trash"></i></button>
                                                    @endcan
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
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>

    $('select.select2').select2({width:'100%', placeholder:'Filtra per categoria' });
    $('select.select2').on('change', function(){
        $('#formFilter').submit();
    });

</script>
@stop
