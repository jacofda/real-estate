<div class="col-sm-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Immagini</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <a title="gestisci media" href="{{route('properties.media', $property->id)}}" class="btn btn-tool text-dark"><i class="far fa-edit"></i></button></a>
            </div>
        </div>
        <div class="card-body">


            <div class="col-12">
                <img src="{{$property->original}}" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
                @foreach($property->media()->img()->orderBy('media_order', 'ASC')->get() as $image)
                    <div class="product-image-thumb @if($loop->index === 0) active @endif"><img src="{{$image->full}}" alt="Product Image"></div>
                @endforeach
            </div>
        </div>
    </div>
    @include('estate::estate.properties.show.ownerships')
    @include('estate::estate.properties.show.requests')
</div>

@push('scripts')
    <script>
        $('.product-image-thumb').on('click', function() {
          const image_element = $(this).find('img');
          $('.product-image').prop('src', $(image_element).attr('src'))
          $('.product-image-thumb.active').removeClass('active');
          $(this).addClass('active');
        });
    </script>
@endpush
