@if($user->can('companies.read') || $user->can('contacts.read'))
    <li class="nav-header text-uppercase">clienti</li>
    @can('companies.read')
        <li class="nav-item">
            <a href="{{route('clients.index')}}" class="nav-link">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>Clienti</p>
            </a>
        </li>
    @endcan
    {{-- @if($user->roles()->first()->hasPermissionTo('contacts.read') || $user->can('contacts.read')) --}}
        {{-- @can('contacts.read')
            <li class="nav-item">
                <a href="{{url('contacts')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Contatti</p>
                </a>
            </li>
        @endcan --}}
    {{-- @endif --}}
@endif





<li class="nav-item">
    <a href="{{route('requests.index')}}" class="nav-link">
        <i class="nav-icon far fa-question-circle"></i>
        <p>Richieste</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('views.index')}}" class="nav-link" >
        <i class="nav-icon far fa-eye"></i>
        <p>Visite</p>
    </a>
</li>


<li class="nav-header text-uppercase">Immobili</li>
<li class="nav-item">
    <a href="{{route('properties.index')}}" class="nav-link" id="menu-properties">
        <i class="nav-icon fas fa-home"></i>
        <p>Proprietà</p>
    </a>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>Campi<i class="fas fa-angle-left right"></i></p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{route('features.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon text-success"></i>
                <p>Caratteristiche</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('tags.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon text-danger"></i>
                <p>Tipologie</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon text-warning"></i>
                <p>POI</p>
            </a>
        </li>


    </ul>
</li>

<li class="nav-item">
    <a href="{{route('ownerships.index')}}" class="nav-link" id="menu-ownership">
        <i class="nav-icon far fa-bookmark"></i>
        <p>Atti</p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link" id="menu-ownership">
        <i class="nav-icon fas fa-balance-scale"></i>
        <p>Compravendite</p>
    </a>
</li>



<li class="nav-item">
    <a href="{{route('bookings.index')}}" class="nav-link">
        <i class="nav-icon fas fa-business-time"></i>
        <p>Booking</p>
    </a>
</li>

<li class="nav-header text-uppercase">WEB</li>
<li class="nav-item">
    <a href="#" class="nav-link" id="menu-cal">
        <i class="nav-icon far fa-images"></i>
        <p>Slide</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link" id="menu-cal">
        <i class="nav-icon fas fa-highlighter"></i>
        <p>In Evidenza</p>
    </a>
</li>



@can('calendars.view')
    <li class="nav-header text-uppercase">calendario</li>
    <li class="nav-item">
        <a href="{{$user->default_calendar->url}}" class="nav-link" id="menu-cal">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>Calendario</p>
        </a>
    </li>
@endcan

{{-- @if($user->can('invoices.read') || $user->can('costs.read') || $user->can('products.read') || $user->can('expenses.read') || $user->can('stats.read')) --}}
    <li class="nav-header text-uppercase">contabilità</li>

    @if( $user->can('invoices.read') || $user->can('costs.read') )
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>Fatture<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                @can('invoices.read')
                    <li class="nav-item">
                        <a href="{{url('invoices')}}" class="nav-link">
                            <i class="far fa-circle nav-icon text-success"></i>
                            <p>Vendite</p>
                        </a>
                    </li>
                @endcan
                @can('costs.read')
                    <li class="nav-item">
                        <a href="{{url('costs')}}" class="nav-link">
                            <i class="far fa-circle nav-icon text-danger"></i>
                            <p>Acquisti</p>
                        </a>
                    </li>
                @endcan
                @can('invoices.read')
                    <li class="nav-item">
                        <a href="{{url('insoluti')}}" class="nav-link">
                            <i class="far fa-circle nav-icon text-warning"></i>
                            <p>Insoluti</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endif



    @can('products.read')
        <hr style="background:rgba(255,255,255,.5); margin-top:0; margin-bottom: 2%; margin-left:2.5%;margin-right: 2.5%; height:.005rem; width:95%;">
        <li class="nav-item">
            <a href="{{url('products')}}" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>Prodotti</p>
            </a>
        </li>
    @endcan
    @can('expenses.read')
        <li class="nav-item">
            <a href="{{url('expenses')}}" class="nav-link">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>Spese</p>
            </a>
        </li>
    @endcan
    @can('stats.read')
        <hr style="background:rgba(255,255,255,.5); margin-top:0; margin-bottom: 2%; margin-left:2.5%;margin-right: 2.5%; height:.005rem; width:95%;">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>Statistiche<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{url('stats/aziende')}}" class="nav-link" id="menu-stats-aziende">
                        <i class="far fa-circle nav-icon text-success"></i>
                        <p>Clienti</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('stats/categorie?year='.date('Y'))}}" class="nav-link" id="menu-stats-categorie">
                        <i class="far fa-circle nav-icon text-danger"></i>
                        <p>Categorie Prodotti</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('stats/balance')}}" class="nav-link" id="menu-stats-bilancio">
                        <i class="far fa-circle nav-icon text-info"></i>
                        <p>Bilancio</p>
                    </a>
                </li>
            </ul>
        </li>
    @endcan



{{-- @endif --}}

@if($user->can('newsletters.read') || $user->can('lists.read') || $user->can('templates.read') )

    <li class="nav-header text-uppercase CampagnaLink">Campagne</li>

    @can('lists.read')
        <li class="nav-item CampagnaLink">
            <a href="{{url('lists')}}" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>Liste</p>
            </a>
        </li>
    @endcan
    @can('lists.create')
        <li class="nav-item CampagnaLink">
            <a href="{{url('create-list')}}?sort=updated_at|desc" class="nav-link">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>Crea Lista</p>
            </a>
        </li>
    @endcan
    @can('templates.read')
        <li class="nav-item CampagnaLink">
            <a href="{{url('templates')}}" class="nav-link">
                <i class="nav-icon fas fa-drafting-compass"></i>
                <p>Templates</p>
            </a>
        </li>
    @endcan
    @can('templates.read')
        <li class="nav-item CampagnaLink">
            <a href="{{url('newsletters')}}" class="nav-link">
                <i class="nav-icon fas fa-paper-plane"></i>
                <p>Newsletters</p>
            </a>
        </li>
    @endcan
@endif

@if( $user->can('users.read') || $user->can('roles.read') || $user->can('referrals.read') || $user->can('agents.read'))
    <li class="nav-header text-uppercase">UTENTI</li>

    @can('users.read')
        <li class="nav-item">
            <a href="{{url('users')}}" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Utenti</p>
            </a>
        </li>
    @endcan

    @can('roles.read')
        <li class="nav-item">
            <a href="{{url('roles')}}" class="nav-link">
                <i class="nav-icon fas fa-user-tag"></i>
                <p>Ruoli</p>
            </a>
        </li>
    @endcan

@endif
