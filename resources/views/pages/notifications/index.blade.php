@extends('layouts.layouts') <!-- or your master layout -->

@section('content')
<div class="container">
    <h3 class="mb-4">My Notifications</h3>

    <!-- Show unread notifications -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Unread Notifications ({{ auth()->user()->unreadNotifications->count() }})</span>
            @if(auth()->user()->unreadNotifications->count())
                <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-primary">Mark All as Read</button>
                </form>
            @endif
        </div>
        <div class="card-body">
            @forelse(auth()->user()->unreadNotifications as $notification)
                <div class="alert alert-warning d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $notification->data['title'] ?? 'Notification' }}</strong><br>
                        {{ $notification->data['message'] ?? '' }}
                        <div><small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small></div>
                    </div>
                    <form action="{{ route('notifications.markRead', $notification->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-outline-success">Mark as Read</button>
                    </form>
                </div>
            @empty
                <p class="text-muted">You have no unread notifications.</p>
            @endforelse
        </div>
    </div>

    <!-- Show read notifications -->
    <div class="card">
        <div class="card-header">Read Notifications</div>
        <div class="card-body">
            @forelse(auth()->user()->readNotifications as $notification)
                <div class="alert alert-light">
                    <strong>{{ $notification->data['title'] ?? 'Notification' }}</strong><br>
                    {{ $notification->data['message'] ?? '' }}
                    <div><small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small></div>
                </div>
            @empty
                <p class="text-muted">No read notifications yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
