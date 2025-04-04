@extends('layout')

@section('title', 'Completed Events')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">✅ Completed <span class="text-primary">Events</span></h2>
        <div class="text-center mb-3">
            <a href="{{ route('events.index') }}" class="btn btn-outline-light">Back to All Events</a>
        </div>

        @forelse ($events as $event)
            <div class="card mb-3 shadow-sm">
                <div class="card-body text-white">
                    <h5 class="card-title">
                        {{ $event->title }}
                        <span style="color: #ccc;">({{ $event->event_id }})</span>
                    </h5>
                    <p class="card-text">{{ $event->description }}</p>
                    <p>
                        <strong style="color: #bbb;">Time:</strong>
                        <span style="color: #eee;">{{ $event->event_time }}</span>
                    </p>
                </div>
            </div>
        @empty
            <p class="text-center text-light">No completed events found.</p>
        @endforelse
    </div>
@endsection
