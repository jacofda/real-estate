<div class="card">
    <div class="card-header">
        <h3 class="card-title l15">Altre anagrafiche</h3>
        <div class="card-tools">
            <a href="{{route('contacts.create')}}?client_id={{$client->id}}" title="aggiungi contatto" class="btn btn-xxs btn-primary newProperty"><i class="fas fa-plus"></i></a>
        </div>
    </div>
    <div class="card-body">
        @if($client->contacts()->exists())
            <div class="table-responsive">
                <table class="table table-borderless table-sm mb-0">
                    <tbody>
                        @foreach($client->contacts as $c)
                            <tr @if($c->primary) class="d-none" @endif>
                                <td style="vertical-align:center;text-align:center; display:block;">
                                    <div class="form-check">
                                      <input data-id="{{$c->id}}" type="radio" name="primary" class="form-check-input" @if($c->primary) checked @else title="clicca per selezionarlo come primario" @endif>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{$c->url}}">
                                        {{$c->fullname}}</b><br>
                                        <code style="color:#222">{{$c->email}}</code>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
