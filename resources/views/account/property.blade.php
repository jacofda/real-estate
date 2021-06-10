
<div class="col-sm-12">


    <div class="panel panel-default mb-0">
        <div class="panel-heading">
            <h5>
                @if(is_null($property->approved))
                    <span class="badge badge-warning">PENDING</span>
                @elseif($property->approved)
                    <span class="badge badge-success">APPROVATO</span>
                @else
                    <span class="badge badge-danger">SCARTATO</span>
                @endif
                {{$property->name}}
            </h5>
        </div>
        <div class="panel-body">
            {{$property->description}}
            <br><br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>{{__('Contratto')}}</td>
                                    <td>{{__($property->contract->name)}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Tipo')}}</td>
                                    <td>{{__($property->type->name)}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Tipologia')}}</td>
                                    <td>{{$property->tag->name}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Città')}}</td>
                                    <td>{{$property->city->comune}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Indirizzo')}}</td>
                                    <td>{{$property->address}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>{{__('Stato')}}</td>
                                    <td>{{__($property->state)}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Riscaldamento')}}</td>
                                    <td>{{__($property->heating)}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('IPE')}}</td>
                                    <td>{{__($property->ipe)}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Classe Energetica')}}</td>
                                    <td>{{$property->energy_class}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Superficie')}}</td>
                                    <td>{{$property->surface}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="panel-footer">
            @if($property->media()->img()->exists())
                <div class="row">
                    @foreach($property->media()->img()->get() as $img)
                        <img style="margin-left:5px;float:left;width:100px;" src="{{$img->thumb}}">
                    @endforeach

                    @foreach($property->media()->where('mime', 'doc')->get() as $file)
                        <div style="margin-left:5px;padding:30px 25px;float:left;height:100px; width:100px;"><a target="_BLANK" href="{{$file->doc}}" title="file">{!!$file->icon!!}</a></div>
                    @endforeach

                </div>
                <div class="row mt-2">
            @else
                <div class="row">
            @endif
                    <div class="col-xs-12">
                        <a href="{{route('account.properties.media', $property->slug_it ?? $property->name_it)}}" class="btn btn-xs btn-warning"><i class="fa fa-image"></i> Aggiungi / Gestisci foto</a>
                    </div>
                </div>
        </div>
</div>
