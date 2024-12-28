@extends('layouts.app')

@section('title', 'Google Calendar')

@section('content')
<div style="padding: 20px; font-family: 'Arial', sans-serif;">
    @if(session('success'))
        <div style="margin: 20px auto; padding: 10px 20px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 8px; text-align: center; font-weight: bold; font-size: 16px; max-width: 600px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="margin: 20px auto; padding: 10px 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 8px; text-align: center; font-weight: bold; font-size: 16px; max-width: 600px;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Navigation and Buttons -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <a href="/dashboard" 
           style="text-decoration: none; padding: 10px 20px; background-color: #800000; color: white; border-radius: 30px; font-size: 14px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s;">
            ← Back
        </a>

        <a href="https://calendar.google.com/calendar/u/0/r?pli=1" 
           target="_blank" 
           style="text-decoration: none; padding: 7px 20px; background-color: #3a4ed3; color: white; border-radius: 30px; font-size: 16px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s;">
            View Calendar
        </a>
    </div>

    <!-- Title Section -->
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="font-size: 35px; font-weight: bold; background: linear-gradient(90deg, #00b4d8, #0077b6); -webkit-background-clip: text; color: transparent;">
            Organize Your Events
        </h1>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 20px;">
        <!-- Left Column -->
        <div>
            <div style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h3 style="text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 10px;">Mini Calendar</h3>
                <iframe src="https://calendar.google.com/calendar/embed?src=lydiaazra%40graduate.utm.my&ctz=Asia%2FKuala_Lumpur&mode=MONTH" 
                        style="border: none; width: 100%; height: 300px; border-radius: 8px;" scrolling="no"></iframe>
            </div>

            <div style="background-color: #f8f9fa; margin-top: 20px; padding: 15px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h3 style="text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 10px;">Quick Links</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">
                    @foreach(['Lecturer' => 'https://lecturer.utm.my', 'Student' => 'https://studentportal.utm.my', 
                              'Library' => 'https://library.utm.my', 'Email' => 'https://mail.utm.my', 
                              'MyUTM' => 'https://myutm.utm.my', 'Staff' => 'https://staff.utm.my'] as $label => $url)
                        <a href="{{ $url }}" target="_blank" style="padding: 8px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; font-size: 14px; text-align: center; font-weight: bold;">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Center Column -->
        <div style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h3 style="text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 10px;">Full Calendar</h3>
            <iframe src="https://calendar.google.com/calendar/embed?src=lydiaazra%40graduate.utm.my&ctz=Asia%2FKuala_Lumpur" 
                    style="border: none; width: 100%; height: 400px; border-radius: 8px;" scrolling="no"></iframe>
        </div>

        <!-- Right Column -->
        <div>
            <div style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h3 style="text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 10px;">Mini Map</h3>
                <iframe 
                    src="https://maps.google.com/maps?q=Faculty%20of%20Computing,%20UTM&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                    style="border: none; width: 100%; height: 300px; border-radius: 8px;" 
                    allowfullscreen>
                </iframe>

                <div style="margin-top: 15px;">
                    <input 
                        type="text" 
                        id="search-location" 
                        placeholder="Search location..." 
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 10px;">
                    <button 
                        onclick="searchLocation()" 
                        style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: bold; cursor: pointer;">
                        Search Location
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        a:hover {
            transform: translateY(-3px);
        }
        button:hover {
            transform: translateY(-2px);
        }
    </style>

    <script>
        let geocoder;
        function searchLocation() {
            let location = document.getElementById('search-location').value;
            if (location) {
                let googleMapsUrl = `https://www.google.com/maps?q=${encodeURIComponent(location)}`;
                window.open(googleMapsUrl, '_blank');
            } else {
                alert('Please enter a location to search.');
            }
        }
    </script>
</div>
@endsection
