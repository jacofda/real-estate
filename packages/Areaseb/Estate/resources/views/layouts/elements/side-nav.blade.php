<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{url('dashboard')}}" class="brand-link">
        <img src="{{Areaseb\Estate\Models\Setting::DefaultLogo()}}" alt="{{config('app.name')}} Logo" class="brand-image img-bg-fff">
    </a>


    <div class="sidebar" id="main-nav">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @include('estate::layouts.elements.menu')

            </ul>
        </nav>
    </div>
</aside>
