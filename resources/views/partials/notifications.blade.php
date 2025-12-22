<a href="#">
    🔔 Уведомления
    @if(auth()->user()->unreadNotifications->count())
        <strong>({{ auth()->user()->unreadNotifications->count() }})</strong>
    @endif
</a>

@if(auth()->user()->unreadNotifications->count())
    <ol class="dropdown">
        @foreach(auth()->user()->unreadNotifications as $notification)
            <li>
                <a href="{{ route('notifications.read', $notification->id) }}">
                    📰 {{ $notification->data['title'] }}
                </a>
            </li>
        @endforeach
    </ol>
@endif
