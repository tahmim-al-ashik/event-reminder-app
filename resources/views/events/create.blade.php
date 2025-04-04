@extends('layout')

@section('title', 'Create Event')

@section('content')
    <div class="container mt-5" style="max-width: 600px;">
        <h2 class="mb-4 text-center">Create a New <span class="text-primary">Event</span></h2>

        <form id="eventForm">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label text-light">Event Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter event title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label text-light">Description</label>
                <textarea id="description" name="description" class="form-control" placeholder="Describe the event" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="event_time" class="form-label text-light">Date & Time</label>
                <input type="datetime-local" id="event_time" name="event_time" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label text-light">Reminder Email (Optional)</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Save Event</button>
            </div>
        </form>

        <div id="eventStatus" class="alert mt-4 d-none text-center text-dark fw-semibold" style="background-color: #ffc; border: 1px solid #ddd;"></div>
    </div>

    <script>
        const userId = {{ auth()->id() ?? 'null' }}; // pass to JS

        document.getElementById("eventForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const data = {
                title: document.getElementById("title").value,
                description: document.getElementById("description").value,
                event_time: document.getElementById("event_time").value,
                email: document.getElementById("email").value,
                user_id: userId,
            };

            const statusEl = document.getElementById("eventStatus");

            if (isOnline()) {
                fetch('/api/events/sync', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(res => {
                        statusEl.className = "alert alert-success mt-4 text-center";
                        statusEl.textContent = "✅ Event created and email reminder will be sent!";
                        statusEl.classList.remove("d-none");
                        document.getElementById("eventForm").reset();
                    })
                    .catch(() => {
                        statusEl.className = "alert alert-danger mt-4 text-center";
                        statusEl.textContent = "❌ Something went wrong while saving the event.";
                        statusEl.classList.remove("d-none");
                    });
            } else {
                saveEventToLocal(data);
                statusEl.className = "alert alert-warning mt-4 text-center";
                statusEl.textContent = "📦 Event saved offline. It will sync when you reconnect.";
                statusEl.classList.remove("d-none");
                document.getElementById("eventForm").reset();
            }
        });
    </script>
@endsection
