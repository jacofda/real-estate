@extends('estate::layouts.app')

@include('estate::layouts.elements.title', ['title' => 'Notifiche'])


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Notifiche</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Modello</th>
                                    <th>Data</th>
                                    <th style="width:30px">Tipo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notifications as $notification)
                                    <tr id="row-{{$notification->id}}">
                                        <td>{{$notification->name}}</td>
                                        <td>
                                            @if($notification->url)
                                                <a target="_BLANK" class="defaultColor" href="{{$notification->notificationable->url}}">{{$notification->notificationable->class}}</a>
                                            @else
                                                <a class="defaultColor btn-modal" href="{{url('notifications/'.$notification->id)}}">{{$notification->modal->class}}</a>
                                            @endif
                                        </td>
                                        <td>
                                            {{$notification->created_at->diffForHumans()}}
                                        </td>
                                        <td class="text-center">
                                            @if($notification->error === 1)
                                                <span class="badge badge-danger"><i class="fas fa-exclamation-circle"></i></span>
                                            @else
                                                <span class="badge badge-info"><i class="fas fa-info-circle"></i></span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {!! Form::open(['method' => 'delete', 'url' => url('notifications/'.$notification->id), 'id' => "form-".$notification->id]) !!}
                                                @if($notification->read)
                                                    <a href="#" class="btn btn-secondary btn-icon btn-sm" title="letta"><i class="fa fa-check"></i></a>
                                                @else
                                                    @if($notification->url)
                                                        <a href="{{url('notifications/'.$notification->id)}}" class="btn btn-primary btn-icon btn-sm markAsRead" title="segna come letta"><i class="fa fa-check"></i></a>
                                                    @else
                                                        <a href="{{$notification->url}}" class="btn btn-primary btn-icon btn-sm markAsRead" title="segna come letta"><i class="fa fa-check"></i></a>
                                                    @endif
                                                @endif
                                                <button type="submit" id="{{$notification->id}}" class="btn btn-danger btn-icon btn-sm delete noCheck"><i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>


                </div>
                <div class="card-footer text-center">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>
    $('a.markAsRead').on('click', function(e){
        e.preventDefault();
        let btn = $(this);
        let url = btn.attr('href');
        let data = {_token: "{{csrf_token()}}"};
        $.post(url, data).done(function(response){
            if(response == 'done')
            {
                btn.removeClass('btn-primary');
                btn.addClass('btn-secondary');

                new Noty({
                    text: "Notifica Letta",
                    type: 'success',
                    theme: 'bootstrap-v4',
                    timeout: 2500,
                    layout: 'topRight'
                }).show();
            }
        })
    })

</script>
@stop
