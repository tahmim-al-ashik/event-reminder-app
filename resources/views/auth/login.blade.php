@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="container mt-5" style="max-width: 500px;">
        <h2 class="text-center mb-4">Login to <span class="text-primary">EventApp</span></h2>

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Login</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="/register" class="text-light">Don't have an account? Register here</a>
        </div>
    </div>
@endsection
