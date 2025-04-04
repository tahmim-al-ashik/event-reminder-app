@extends('layout')

@section('title', 'Edit Event')

@section('content')
    <div class="container mt-5" style="max-width: 600px;">
        <h2 class="mb-4 text-center">Edit <span class="text-primary">Event</span></h2>

        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label text-light">Event Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $event->title }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-light">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ $event->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="event_time" class="form-label text-light">Date & Time</label>
                <input type="datetime-local" name="event_time" id="event_time" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->event_time)) }}" required>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label text-light">Reminder Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $event->email }}">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update Event</button>
            </div>
        </form>
    </div>
@endsection
