<div class="col-12">
    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="pt-2 px-3"><h3 class="card-title">Card Title</h3></li>
                <li class="nav-item">
                    <a class="nav-link  active" id="owners-tab" data-toggle="pill" href="#owners" role="tab" aria-controls="owners" aria-selected="false">Propietari</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="site-tab" data-toggle="pill" href="#site" role="tab" aria-controls="site" aria-selected="false">Sito</a>
                </li>
                @if($property->contract->id !== 1)
                    <li class="nav-item">
                        <a class="nav-link" id="bookings-tab" data-toggle="pill" href="#bookings" role="tab" aria-controls="bookings" aria-selected="true">Booking</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" id="docs-tab" data-toggle="pill" href="#docs" role="tab" aria-controls="docs" aria-selected="false">Documenti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="appointments-tab" data-toggle="pill" href="#appointments" role="tab" aria-controls="appointments" aria-selected="false">Visite</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-two-tabContent">
                <div class="tab-pane fade active show" id="owners" role="tabpanel" aria-labelledby="owners-tab">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                </div>
                <div class="tab-pane fade" id="site" role="tabpanel" aria-labelledby="site-tab">
                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                </div>
                @if($property->contract->id !== 1)
                    <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
                    Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div>
                @endif
                <div class="tab-pane fade" id="docs" role="tabpanel" aria-labelledby="docs-tab">
                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                </div>

                <div class="tab-pane fade" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                </div>

            </div>
        </div>
    </div>
</div>
