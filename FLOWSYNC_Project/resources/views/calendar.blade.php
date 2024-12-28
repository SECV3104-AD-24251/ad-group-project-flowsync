@extends('layouts.app')

@section('title', 'Google Calendar')

@section('content')
    @if(session('success'))
        <p style="color: #28a745; text-align: center; font-weight: bold; font-size: 18px;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: #dc3545; text-align: center; font-weight: bold; font-size: 18px;">{{ session('error') }}</p>
    @endif

    <br>
    <!-- Back Button (Left side) -->
    <a href="/dashboard" 
       style="text-decoration: none; padding: 8px 20px; background: linear-gradient(135deg, #800000, #660000); color: white; 
              border-radius: 50px; font-size: 16px; font-weight: 500; box-shadow: 0 6px 8px rgba(0,0,0,0.1); 
              transition: background 0.3s ease, transform 0.3s ease; text-transform: uppercase; 
              display: inline-block; margin-left: 10px;">
        ← Back
    </a>

    <!-- Google Calendar Button -->
    <div style="text-align: right; margin-bottom: 20px; margin-right: 20px;">
        <a href="https://calendar.google.com/calendar/u/0/r?pli=1" 
           target="_blank" 
           style="text-decoration: none; padding: 12px 30px; background: linear-gradient(135deg, #6e7dff, #3a4ed3); color: white; 
                  border-radius: 50px; font-size: 20px; font-weight: 600; box-shadow: 0 6px 12px rgba(0,0,0,0.1); 
                  transition: background 0.3s ease, transform 0.3s ease; text-transform: uppercase; 
                  vertical-align: middle; margin-top: -50px;">
            View Calendar
        </a>
    </div>

    <!-- Title & Greeting Section (Centered) -->
    <div style="text-align: center; margin-top: -50px;">
    <h1 style="font-size: 32px; font-weight: bold; font-family: 'Arial', sans-serif; 
               background: linear-gradient(135deg, #00b4d8, #ffffff); 
               -webkit-background-clip: text; color: transparent; 
               text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);">
        Organize Your Events with Ease
    </h1>
</div>    
<div style="display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 20px; align-items: start; height: 100vh; padding: 20px;">
        
        <!-- Left Column -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <!-- Mini Calendar -->
            <div style="background: linear-gradient(135deg, #f7f9fc, #e3e9f7); padding: 20px 30px; border-radius: 10px; box-shadow: 0 6px 15px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; color: #333; margin-bottom: 10px;text-align: center;">Mini Calendar</h3>
                <iframe src="https://calendar.google.com/calendar/embed?src=lydiaazra%40graduate.utm.my&ctz=Asia%2FKuala_Lumpur&mode=MONTH" 
                        style="border: 0; width: 100%; height: 250px;" frameborder="0" scrolling="no"></iframe>
            </div>

            <!-- Quick Links -->
            <div style="background: linear-gradient(135deg, #f8f9fa, #f0f4f8); padding: 15px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <h3 style="font-size: 16px; color: #333; margin-bottom: 10px;text-align: center;">Quick Links</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">
                    <!-- Quick Links Buttons -->
                    @foreach(['Lecturer' => 'https://lecturer.utm.my', 'Student' => 'https://studentportal.utm.my', 
                              'Library' => 'https://library.utm.my', 'Email' => 'https://mail.utm.my', 
                              'MyUTM' => 'https://myutm.utm.my', 'Staff' => 'https://staff.utm.my'] as $label => $url)
                        <a href="{{ $url }}" target="_blank" style="padding: 10px; background: linear-gradient(135deg, #007bff, #0056b3); color: white; 
                            text-decoration: none; border-radius: 5px; text-align: center; font-size: 12px; width: 100px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Center: Full Google Calendar -->
        <div style="background: linear-gradient(135deg, #ffffff, #f9f9f9); padding: 20px 30px; border-radius: 10px; box-shadow: 0 6px 15px rgba(0,0,0,0.1);">
            <h3 style="font-size: 18px; color: #333; margin-bottom: 10px; text-align: center;">Full Calendar</h3>
            <iframe src="https://calendar.google.com/calendar/embed?src=lydiaazra%40graduate.utm.my&ctz=Asia%2FKuala_Lumpur" 
                    style="border: 0; width: 100%; height: 400px;" frameborder="0" scrolling="no"></iframe>
        </div>
    
        <!-- Right Sidebar: Mini Map -->
        <div id="mini-maps" style="width: 100%; display: flex; flex-direction: column; align-items: center; justify-content: flex-start;">
            <div id="map-container" style="width: 100%; height: 250px; border: 1px solid #ccc; border-radius: 10px; overflow: hidden; margin-bottom: 10px;">
                <!-- Mini Map -->
                <iframe 
                    src="https://maps.google.com/maps?q=Faculty%20of%20Computing,%20UTM&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                    style="width: 100%; height: 100%; border: none; border-radius: 10px;" 
                    allowfullscreen>
                </iframe>
            </div>
        
            <div id="search-location-container" style="width: 100%; margin-top: 5px;">
                <input 
                    type="text" 
                    id="search-location" 
                    placeholder="Search location..." 
                    style="width: 100%; padding: 10px; border-radius: 25px; border: 1px solid #e3e3e3; font-size: 14px; box-sizing: border-box;">
                <button 
                    onclick="searchLocation()" 
                    style="padding: 10px; background: linear-gradient(135deg, #007bff, #0056b3); color: white; border: none; border-radius: 25px; width: 100%; font-size: 14px; cursor: pointer; margin-top: 10px;">
                    Search Location
                </button>
            </div>
        </div>
    </div>

    <!-- Hover and transition effects -->
    <style>
        /* Hover effect on navigation buttons */
        button:hover {
            background: linear-gradient(135deg, #218838, #1e7e34); /* Darker green */
            transform: translateY(-4px); /* Lift effect */
        }

        /* Hover effect on dropdown */
        select:hover {
            background-color: #f8f9fa; /* Light background on hover */
            border-color: #007bff; /* Blue border on hover */
        }

        /* Focus effect for dropdown */
        select:focus {
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5); /* Blue glow effect */
            border-color: #007bff;
        }
    </style>

    <!-- Google Maps API and Search Functionality -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv31yyg2Omof0eRZDnpeIpgMKdeE-237M&callback=initMap" async defer></script>
    <script>
let map;
let geocoder;

function initMap() {
    map = new google.maps.Map(document.getElementById('map-container'), {
        center: {lat: 1.2921, lng: 36.8219}, // Default location: Nairobi
        zoom: 12
    });
    geocoder = new google.maps.Geocoder();
}

function searchLocation() {
    let location = document.getElementById('search-location').value;

    if (location) {
        // Construct the Google Maps URL for the search query
        let googleMapsUrl = `https://www.google.com/maps?q=${encodeURIComponent(location)}`;
        
        // Redirect the user to the Google Maps page
        window.open(googleMapsUrl, '_blank');  // Open in a new tab
    } else {
        alert('Please enter a location to search.');
    }
}

    </script>
@endsection
