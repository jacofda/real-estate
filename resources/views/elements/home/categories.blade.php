@php
    $tagClass = new \Areaseb\Estate\Models\Tag;
@endphp

<section class="section-md text-center text-sm-left bg-dark">
    <div class="container">
        <h2>{{__('I più ricercati')}}</h2>
        <hr>
        <div class="row offset-11">

            @foreach(\Areaseb\Estate\Models\Tag::mostPopular() as $tag)
                <div class="col-xs-12 col-sm-6">
                    <a href="{{route(app()->getLocale().'.immobili')}}?tag_id={{$tag->id}}" class="img-thumbnail-variant-1">
                        <img src="{{asset('theme/images/categories-'.$loop->iteration.'.jpg')}}" alt="" width="570" height="380">
                        <div class="caption">
                            <h4 class="text-white">{{$tag->name}}</h4>
                            <p>{{$tag->properties()->count()}} {{__('Immobili')}}</p>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</section>
