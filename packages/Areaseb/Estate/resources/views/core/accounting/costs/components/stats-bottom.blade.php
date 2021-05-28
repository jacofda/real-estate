<div class="row">

    <div class="col-12 col-sm-4 col-lg-2 ">
        <div class="small-box bg-info">
            <div class="inner">
                <h3 class="mb-0">{{$imponibile}}</h3>
                <p>Imponibile</p>
            </div>
            <div class="icon"><i class="ion ion-bag"></i></div>
        </div>
    </div>

    <div class="col-12 col-sm-4 col-lg-2">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 class="mb-0">{{$imposte}}</h3>
                <p>Imposte</p>
            </div>
            <div class="icon"><i class="ion ion-stats-bars"></i></div>
        </div>
    </div>

    <div class="col-12 col-sm-4 col-lg-2">
        <div class="small-box bg-success">
            <div class="inner">
                <h3 class="mb-0">{{$totale}}</h3>
                <p>Totale</p>
            </div>
            <div class="icon"><i class="ion ion-cash"></i></div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="row">
            @foreach($categories as $expense => $total)
                @if(strpos($total, '0,0') === false)
                    <div class="col">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h6 class="mb-0">{{$total}}</h6>
                                <p class="mb-0">{{$expense}}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>


</div>
