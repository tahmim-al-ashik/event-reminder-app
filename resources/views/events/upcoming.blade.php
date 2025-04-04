@extends('layout')

@section('title', 'Upcoming Events')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">📆 Upcoming <span class="text-primary">Events</span></h2>
        <div class="text-center mb-3">
            <a href="{{ route('events.index') }}" class="btn btn-outline-light">Back to All Events</a>
        </div>

        @forelse ($events as $event)
            <div class="card mb-3 shadow-sm">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="card-title mb-1">
                            {{ $event->title }}
                            <span style="color: #ccc;">({{ $event->event_id }})</span>
                        </h5>
                        <a href="{{ route('events.invite.form', $event->id) }}"
                           class="btn btn-sm btn-outline-light"
                           title="Send Invitation">
                            📧 Invite
                        </a>
                    </div>

                    <p class="card-text mt-2">{{ $event->description }}</p>
                    <p>
                        <strong style="color: #bbb;">Time:</strong>
                        <span style="color: #eee;">{{ $event->event_time }}</span>
                    </p>
                </div>
            </div>
        @empty
            <p class="text-center text-light">No upcoming events found.</p>
        @endforelse
    </div>
@endsection
