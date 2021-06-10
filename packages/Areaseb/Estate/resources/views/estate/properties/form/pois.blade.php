{{-- collapsed-card --}}
<div class="card collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Caratteristiche di zona</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="card-body">
        @foreach(\Areaseb\Estate\Models\Poi::orderBy('name_it', 'ASC')->get() as $poi)
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" name="pois[]" value="{{$poi->id}}" class="custom-control-input" id="customCheck{{$poi->id}}">
                <label class="custom-control-label" for="customCheck{{$poi->id}}">{{$poi->name_it}}</label>
            </div>
        @endforeach
    </div>
</div>
