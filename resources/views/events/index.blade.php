@extends('layout')

@section('title', 'All Events')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4">All Your <span class="text-primary">Events</span></h2>

        <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
            <a href="{{ route('events.create') }}" class="btn btn-primary">Add New Event</a>
            <a href="{{ route('events.upcoming') }}" class="btn btn-outline-info">Upcoming</a>
            <a href="{{ route('events.completed') }}" class="btn btn-outline-light">Completed</a>
            <a href="{{ route('events.export') }}" class="btn btn-outline-success">Download CSV</a>
        </div>

        @if ($events->isEmpty())
            <p class="text-center text-light">No events found. Start by creating one!</p>
        @endif

        @foreach ($events as $event)
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
                    <p><strong style="color: #bbb;">Time:</strong> <span style="color: #eee;">{{ $event->event_time }}</span></p>
                    <p><strong style="color: #bbb;">Email:</strong> <span style="color: #eee;">{{ $event->email ?? 'N/A' }}</span></p>

                    <div class="d-flex gap-2">
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
