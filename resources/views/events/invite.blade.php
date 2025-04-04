@extends('layout')

@section('title', 'Invite to Event')

@section('content')
    <div class="container mt-5" style="max-width: 600px;">
        <h2 class="mb-4 text-center">📧 Invite Someone to <span class="text-primary">{{ $event->title }}</span></h2>

        <form action="{{ route('events.invite.send', $event->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label text-light">Recipient Email</label>
                <input type="email" name="email" class="form-control" placeholder="invite@example.com" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Send Invite</button>
            </div>
        </form>
    </div>
@endsection
