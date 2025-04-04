@extends('layout')

@section('title', 'Import Events')

@section('content')
    <div class="container mt-5" style="max-width: 600px;">
        <h2 class="mb-4 text-center">📥 Import <span class="text-primary">Events</span> from CSV</h2>

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('events.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="csv_file" class="form-label text-light">Choose CSV File</label>
                <input type="file" name="csv_file" id="csv_file" class="form-control" required>
            </div>

            <div class="d-grid">
                <button class="btn btn-success">Upload & Import</button>
            </div>
        </form>

        <div class="mt-5">
            <h5 class="text-light">🧾 CSV Format Example:</h5>
            <pre class="bg-dark text-white p-3 rounded">
title,description,event_time,email
Meeting with team,Discuss project goals,2025-04-10 14:00:00,team@example.com
Doctor appointment,Check-up,2025-04-15 10:00:00,
            </pre>
        </div>
    </div>
@endsection
