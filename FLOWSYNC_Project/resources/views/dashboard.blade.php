@extends('layouts.app')

@section('content')
<div class="dashboard-container text-center">
    <h1 class="mb-4">Dashboard</h1>
    <p>Welcome, {{ session('user') }}! Here's the dashboard.</p>
</div>
@endsection
