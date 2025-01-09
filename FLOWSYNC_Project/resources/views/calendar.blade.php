@extends('layouts.app')

@section('title', 'Registered Schedule')

@section('content')
<div style="padding: 20px; font-family: 'Arial', sans-serif;">
    <!-- Notifications -->
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

    <!-- Navigation Buttons -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <a href="/student-dashboard" 
           style="text-decoration: none; padding: 10px 20px; background-color: #800000; color: white; border-radius: 30px; font-size: 14px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s;">
            ← Back
        </a>

        <div style="display: flex; gap: 10px;">
            <button style="text-decoration: none; padding: 10px 20px; background-color: #3a4ed3; color: white; border-radius: 40px; font-size: 14px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s;">
                Edit
            </button>
            <a href="https://calendar.google.com/calendar/u/0/r?pli=1" 
               target="_blank" 
               style="text-decoration: none; padding: 10px 20px; background-color: #3a4ed3; color: white; border-radius: 30px; font-size: 14px; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s;">
                View Calendar
            </a>
        </div>
    </div>

    <!-- Title Section -->
    <div style="text-align: center; margin-bottom: 20px;">
        <h1 style="font-size: 25px; font-weight: bold; color: #333;">Registered Schedule</h1>
    </div>

    <!-- Schedule Table -->
    <div style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: flex; justify-content: center;">
        <table style="width: 95%; border-collapse: collapse;">
            <thead>
                <tr style="background-color:rgb(241, 243, 245);">
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Course</th>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Section</th>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Time Slot</th>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Place</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover-details" data-details="AI - MON 10AM-1PM - MPK 10">
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">SECJ3553 - ARTIFICIAL INTELLIGENCE</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">01</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">MON 10AM - 1PM</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">MPK 10</td>
                </tr>
                <tr class="hover-details" data-details="AD - MON 8AM-10AM - MPK 5">
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">SECV3104 - APPLICATION DEVELOPMENT</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">02</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">MON 8AM - 10AM</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">MPK 5</td>
                </tr>
                <tr class="hover-details" data-details="AD - TUE 8AM-10AM - CGMTL">
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">SECV3104 - APPLICATION DEVELOPMENT</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">02</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">TUE 8AM - 10AM</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">CGMTL</td>
                </tr>
                <tr class="hover-details" data-details="GM - WED 10AM-1PM - MCASE">
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">SECV3113 - GEOMETRIC MODELLING</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">01</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">WED 10AM - 1PM</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">MCASE</td>
                </tr>
                <tr class="hover-details" data-details="FIP - THURS 8AM-11AM - IDAL LAB">
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">SECV3213 - FUNDAMENTAL OF IMAGE PROCESSING</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">01</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">THURS 8AM - 11AM</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">IDAL LAB</td>
                </tr>
            </tbody>
        </table>
    </div>

    <style>
        a:hover {
            transform: translateY(-3px);
        }
        button:hover {
            transform: translateY(-2px);
        }
        .hover-details {
            position: relative;
        }
        .hover-details:hover::after {
            content: attr(data-details);
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color:rgb(82, 141, 205);
            color: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            white-space: nowrap;
            z-index: 10;
        }
    </style>
</div>
@endsection
