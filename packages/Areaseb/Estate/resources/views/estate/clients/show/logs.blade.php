<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title l15">
                    <a title="visualizza richieste" href="#" class="updateDataTable text-dark" data-search="Nota"><u>Logs/Note</u>
                </h3>
                <div class="card-tools">
                    <a href="#" title="aggiungi nota" class="btn btn-xxs btn-primary newLog"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <th>Tipologia</th>
                                <th>Data</th>
                                <th>Immobile</th>
                                <th data-sortable="false">Nota</th>
                                <th data-sortable="false"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                @include('estate::estate.clients.show.logs.'.$log->class)
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('estate::estate.clients.show.log-modal')

@push('scripts')
    <script>
    // let table = $('#table').DataTable(window.tableOptions);
    //
    // //$('#table_filter input').val('ciao');
    //
    // table.search("no").draw();
    //
    // $('#table').on('click', '.logDelete', function(e){
    //     e.preventDefault();
    //     let url = $(this).attr('href');
    //     let row = $(this).parent('td').parent('tr');
    //
    //     Swal.fire({
    //         title: 'Siete Sicuri',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Sì. elimina!',
    //         cancelButtonText: 'Annulla.'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             axios.delete(url, {_token:token}).then(response => {
    //                 console.log(response.data);
    //                 if(response.data == 'done')
    //                 {
    //                     row.remove();
    //                 }
    //                 else
    //                 {
    //                     err("Errore, non siamo riusciti ad completare l'eliminazione")
    //                 }
    //             });
    //         }
    //     });
    // });

    $('a.newLog').on('click', function(){
        let md = $('#log-modal');
        $('.modal').css({'background-color':'rgba(0,0,0,.7)'});
        $(md).modal('show');
        $('button.btn-save-log').attr('disabled', true);
    });

    </script>
@endpush
