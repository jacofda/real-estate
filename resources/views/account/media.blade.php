@extends('layouts.app')

@section('meta')
    <title>{{__('Aggiungi Foto')}}</title>
@stop

@section('css')
<link rel="stylesheet" href="{{asset('plugins/dropzone/min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/popup/min.css')}}">
@stop


@section('content')
    <section class="text-left account-page" >
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1>{{__('Aggiungi Foto')}}</h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('home')}}">Account</a>
                        </li>
                        <li>
                            <a href="{{route('account.properties')}}">{{__('I miei immobili')}}</a>
                        </li>
                        <li class="active">{{__('Aggiungi Foto')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="section-md text-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 mb-4">

                    <div class="btn-group-vertical" role="group" aria-label="..." style="width:100%">
                        <a href="{{route('account.credentials')}}" class="btn btn-primary-transparent btn-xs" style="width:100%; border-bottom:none;">{{__('Credenziali')}}</a>
                        <a href="{{route('account.client')}}" class="btn btn-primary-transparent btn-xs" style="width:100%; border-bottom:none;">{{__('Dati anagrafici')}}</a>
                        <a href="{{route('account.properties')}}" class="btn btn-primary-transparent btn-xs" style="width:100%;">{{__('I miei immobili')}}</a>
                    </div>

                </div>
                <div class="col-lg-9 col-lg-offset-1">

                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <form action="{{route('account.properties.media.store')}}" class="dropzone" id="dropzoneForm">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                        <input name="mediable_type" type="hidden" value="{{$property->class}}" />
                                        <input name="mediable_id" type="hidden" value="{{$property->id}}" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                   <div class="clearfix"></div>

                    @if($property->media()->where('mime', 'image')->exists())
                        <div class="card card-outline card-success mt-5">
                            <div class="card-header">IMMAGINI</div>
                            <table class="table table-sm table-bordered mb-0 pb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">preview</th>
                                        <th data-toggle="tooltip" title="peso e dimensioni dell'immagine originale">size</th>
                                        <th></th>
                                        <th class="d-none"></th>
                                    </tr>
                                </thead>
                                <tbody class="popup-gallery">
                                    @foreach($property->media()->where('mime','image')->orderBy('media_order', 'ASC')->get() as $file)
                                        <tr>
                                            <td class="align-middle text-center image-to-pop">
                                                <a class="image-popup thumb" href="{{ $file->display }}" title="{{$file->description}}" >
                                                    <img src="{{ $file->thumb }}">
                                                </a>
                                            </td>
                                            <td><small>{{$file->dimension}}<br>{{$file->kb}}</small></td>
                                            <td class="align-middle text-center">
                                                <form method="POST" action="{{url('api/media/delete')}}">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <input type="hidden" name="id" value="{{$file->id}}">
                                                    <button class="btn btn-xs btn-danger" type="submit"><i class="fa fa-trash" style="width: 20px;height: 25px;padding-top: 4px;"></i> </button>
                                                </form>
                                            </td>
                                            <td class="d-none">{{$file->id}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @endif

                     <div class="clearfix"></div>



                     @if($property->media()->where('mime', 'doc')->exists())
                         <div class="card card-outline card-warning mt-5">
                             <div class="card-header">FILES</div>
                             <table class="table table-sm table-bordered mb-0 pb-0">
                                 <thead class="thead-light">
                                     <tr>
                                         <th class="text-center">descrizione file</th>
                                         <th class="text-center">preview</th>
                                         <th class="text-center">size</th>
                                         <th class="text-center"></th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach($property->media()->where('mime','doc')->get() as $file)
                                         <tr>
                                             <td class="align-middle text-center">
                                                 <form method="POST" action="{{url('api/media/update')}}" class="col-sm-12 form-description">
                                                     {{csrf_field()}}
                                                     <input type="hidden" name="id" value="{{$file->id}}">
                                                     <div class="input-group">
                                                         <input type="text" name="description" class="form-control" value="{{$file->description}}" />
                                                         <button class="btn btn-primary btn-sm tbr0" id="{{$file->id}}" style="position:absolute;border-top-left-radius: 0;border-bottom-left-radius: 0; padding-right:15px; padding-left:15px;"><i class="fa fa-save"></i></button>
                                                     </div>
                                                 </form>
                                             </td>
                                             <td class="align-middle text-center">
                                                 <a class="btn btn-xs btn-primary" target="_BLANK" href="{{$file->doc}}" >
                                                     <i class="fa fa-disk"></i>{{$file->filename}}
                                                 </a>
                                             </td>
                                             <td class="align-middle text-center">
                                                 <small>{{$file->kb}}</small>
                                             </td>

                                             <td class="align-middle text-center">
                                                 <form method="POST" action="{{url('api/media/delete')}}">
                                                     {{csrf_field()}}
                                                     {{method_field('DELETE')}}
                                                     <input type="hidden" name="id" value="{{$file->id}}">
                                                     <button class="btn btn-xs btn-danger" type="submit"><i class="fa fa-trash"></i> </button>
                                                 </form>
                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     @endif


                </div>
            </div>
        </div>
    </section>


    {{-- @include('estate::components.media.files') --}}


@stop

@section('scripts')
    <script src="{{asset('plugins/dropzone/min.js')}}"></script>
    <script src="{{asset('plugins/popup/min.js')}}"></script>
<script>
    (function(){


        let text = "<strong>Clicca per caricare immagini e documenti. (jpg, png, pdf, doc, xls, ...)</strong><br> Max upload size 8MB";

        Dropzone.options.dropzoneForm = {
            paramName: "file",
            maxFilesize: 200,
            dictDefaultMessage: text,
            sending: function(file, xhr, formData) {
                formData.append("mediable_id", "{{$property->id}}");
                formData.append("mediable_type", "{{str_replace("\\","\\\\", $property->full_class)}}");
                formData.append("directory", "{{$property->directory}}");
            },
            init: function () {
                this.on('queuecomplete', function () {
                    location.reload();
                });
            },
        };

        $('.popup-gallery tr td').magnificPopup({delegate: 'a',type: 'image',tLoading: 'Loading image #%curr%...',mainClass: 'mfp-img-mobile',gallery: {enabled: true,navigateByImgClick: true,preload: [0,1] },image: {tError: '<a href="%url%">The image #%curr%</a> errorrrrrr',titleSrc: function(item) {return item.el.attr('title') + '<small>{{ config('app.name') }}</small>';}}});


    })(jQuery);
</script>
@stop
