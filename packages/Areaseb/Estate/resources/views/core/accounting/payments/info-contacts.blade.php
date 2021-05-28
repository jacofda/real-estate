<div class="col">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recapiti</h3>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center"><b>Ragion Sociale</b> <span>{{$invoice->client->rag_soc}}</span></li>
              <li class="list-group-item d-flex justify-content-between align-items-center"><b>Email</b> <span>{{$invoice->client->email}}</span></li>
              <li class="list-group-item d-flex justify-content-between align-items-center"><b>Telefono</b> <span>{{$invoice->client->telefono}}</span></li>
              <li class="list-group-item d-flex justify-content-between align-items-center"><b>Indirizzo</b> <span>{{$invoice->client->indirizzo}}</span></li>
              <li class="list-group-item d-flex justify-content-between align-items-center"><b>Provincia</b> <span>{{$invoice->client->provincia}}</span></li>
            </ul>
        </div>
    </div>
</div>
