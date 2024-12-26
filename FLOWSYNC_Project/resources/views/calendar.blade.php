@extends('layouts.app')

@section('title', 'Google Calendar')

@section('content')
    @if(session('success'))
        <p style="color: green; text-align: center;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red; text-align: center;">{{ session('error') }}</p>
    @endif

    <br><br>

    

    <!-- Google Calendar Embed Section -->
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <iframe src="https://calendar.google.com/calendar/embed?src=lydiaazra%40graduate.utm.my&ctz=Asia%2FKuala_Lumpur" 
            style="border: 0" width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
    </div>

@endsection

