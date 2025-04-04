<!-- layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Event Reminder App')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#000000">

    <style>
        body {
            background-color: #000;
            color: #fff;
        }
        .navbar, .footer {
            background-color: #111;
        }
        .card {
            background-color: #1a1a1a;
            border: none;
        }
        .btn-primary, .btn-success, .btn-warning, .btn-danger {
            border-radius: 0;
        }
        .form-control {
            background-color: #2c2c2c;
            color: #fff;
            border: 1px solid #444;
        }
        .form-control::placeholder {
            color: #aaa;
        }
        a, a:hover {
            color: #0d6efd;
        }
    </style>
{{--    @include('pwa::meta')--}}
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="/">EventApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item"><a class="nav-link" href="/events">All Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="/events/create">Create</a></li>
                    <li class="nav-item"><a class="nav-link" href="/events/import">Import</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    @if(session('success'))
        <div class="container">
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="container">
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        </div>
    @endif

    @yield('content')
</main>

<footer class="footer py-3 mt-4">
    <div class="container text-center text">
        &copy; {{ date('Y') }} Event Reminder App. Stay organized, stay awesome.
    </div>
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function isOnline() {
        return navigator.onLine;
    }
    function saveEventToLocal(data) {
        let stored = localStorage.getItem('offlineEvents');
        let events = stored ? JSON.parse(stored) : [];
        events.push(data);
        localStorage.setItem('offlineEvents', JSON.stringify(events));
        alert("You are offline. Event saved and will be synced when online.");
    }
    async function syncOfflineEvents() {
        let stored = localStorage.getItem('offlineEvents');
        if (!stored || stored === '[]') return;
        let events = JSON.parse(stored);
        for (const event of events) {
            try {
                await fetch('/api/events/sync', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(event)
                });
            } catch (e) {
                console.log("Sync failed:", e);
            }
        }
        localStorage.removeItem('offlineEvents');
        alert("Offline events synced successfully!");
    }
    window.addEventListener('online', syncOfflineEvents);
</script>


<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js')
            .then(() => console.log('PWA: Service Worker registered'))
            .catch(err => console.error('PWA SW registration failed:', err));
    }
</script>

</body>
</html>
