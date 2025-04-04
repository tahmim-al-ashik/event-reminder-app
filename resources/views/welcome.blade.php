@extends('layout')

@section('title', 'Welcome')

@section('content')
    <div class="container text-center mt-5">
        <h1 class="display-4 fw-bold">Welcome to <span class="text-primary">EventApp</span></h1>
        <p class="lead">Your simple, smart, and offline-ready event reminder system.</p>
        <p class="mb-4">Plan your tasks, set event reminders, and never forget what matters.</p>

        <a href="/login" class="btn btn-primary btn-lg me-2">Login</a>
        <a href="/register" class="btn btn-outline-light btn-lg">Register</a>

        <hr class="my-5">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h5>Why use EventApp?</h5>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2">✅ Create and manage events easily</li>
                    <li class="mb-2">✅ Works offline and syncs when you're back online</li>
                    <li class="mb-2">✅ Import and export events in CSV</li>
                    <li class="mb-2">✅ Get email reminders for important events</li>
                    <li class="mb-2">✅ Mobile friendly and installable as a PWA</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
