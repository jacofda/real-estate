@if($user->can('accounting.read') || $user->can('newsletter.read'))
    @php
        $unread = Areaseb\Estate\Models\Notification::countUnread();
        $all = Areaseb\Estate\Models\Notification::count();
    @endphp
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            @if($unread)
                <span class="badge badge-warning navbar-badge">{{$unread}}</span>
            @else
                <span class="badge navbar-badge">0</span>
            @endif

        </a>
        @if($all)
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{$all}} Notifiche</span>
                @foreach(Areaseb\Estate\Models\Notification::unread()->latest()->take(4)->get() as $notification)
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        {{substr($notification->name, 0, 19)}} ...
                        <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
                    </a>
                @endforeach
                <div class="dropdown-divider"></div>
                <a href="{{url('notifications')}}" class="dropdown-item dropdown-footer">Vedi tutte le notifiche</a>
            </div>
        @endif
    </li>
@endif
