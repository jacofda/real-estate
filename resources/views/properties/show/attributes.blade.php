<div class="col-xs-12">
    <h4 class="border-bottom">{{__('Caratteristiche')}}</h4>
    <div class="table-mobile offset-11">
        <table class="table table-default">
            <tbody>
                @if($property->state)
                    <tr>
                        <td>{{__('Stato')}}</td>
                        <td>{{__($property->state)}}</td>
                    </tr>
                @endif
                @if($property->heating)
                    <tr>
                        <td>{{__('Riscaldamento')}}</td>
                        <td>{{__($property->heating)}}</td>
                    </tr>
                @endif
                @if($property->ipe)
                    <tr>
                        <td>{{__('IPE')}}</td>
                        <td>{{$property->ipe}}</td>
                    </tr>
                @endif
                @if($property->energy_class)
                    @if(strlen($property->energy_class) === 1)
                        <tr>
                            <td>{{__('Classe Energetica')}}</td>
                            <td>{{$property->energy_class}}</td>
                        </tr>
                    @endif
                @endif
                @if($property->surface)
                    <tr>
                        <td>{{__('Superficie')}}</td>
                        <td>{{$property->surface}} mq</td>
                    </tr>
                @endif
                @if($property->land_surface)
                    <tr>
                        <td>{{__('Plot')}}</td>
                        <td>{{$property->land_surface}} mq</td>
                    </tr>
                @endif
                @if($property->garden_surface)
                    <tr>
                        <td>{{__('Giardino')}}</td>
                        <td>{{$property->garden_surface}} mq</td>
                    </tr>
                @endif
                @if($property->floor)
                    <tr>
                        <td>{{__('Al piano')}}</td>
                        <td>
                            @if($property->floor === 1)
                                {{__('Primo Piano')}}
                            @elseif($property->floor === 2)
                                {{__('Secondo Piano')}}
                            @elseif($property->floor === 3)
                                {{__('Terzo Piano')}}
                            @elseif($property->floor === 4)
                                {{__('Quarto Piano')}}
                            @elseif($property->floor === 5)
                                {{__('Quinto Piano')}}
                            @endif
                        </td>
                    </tr>
                @endif
                @if($property->n_bathrooms)
                    <tr>
                        <td>N. {{__('bagni')}}</td>
                        <td>{{$property->n_bathrooms}}</td>
                    </tr>
                @endif

                @if($property->n_bedrooms)
                    <tr>
                        <td>N. {{__('camere')}}</td>
                        <td>{{$property->n_bedrooms}}</td>
                    </tr>
                @endif
                @if($property->n_garages)
                    <tr>
                        <td>N. {{__('garages')}}</td>
                        <td>{{$property->n_garages}}</td>
                    </tr>
                @endif
                @if($property->n_floors)
                    <tr>
                        <td>N. {{__('Piani')}}</td>
                        <td>{{$property->n_floors}}</td>
                    </tr>
                @endif

                @if($property->condo_expenses)
                    <tr>
                        <td>{{__('Spese Condominiali')}}</td>
                        <td>{{$property->condo_expenses}}</td>
                    </tr>
                @endif

                @if($property->built_at)
                    <tr>
                        <td>{{__('Anno di costruzione')}}</td>
                        <td>{{$property->built_at}}</td>
                    </tr>
                @endif

                @foreach($property->feats as $feat)
                    <tr>
                        <td>{{$feat->name}}</td>
                        <td><i class="fa fa-check text-success"></i></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <h4 class="border-bottom offset-8">{{__('Descrizione')}}</h4>
    {!!$property->description!!}
</div>
