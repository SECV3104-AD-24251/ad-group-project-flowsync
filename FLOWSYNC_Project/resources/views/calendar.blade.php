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
    <div style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8f9fa;">
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Course</th>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Section</th>
                    <th style="text-align: left; padding: 10px; border-bottom: 1px solid #ddd;">Time Slot</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">SECVXXX - Fundamental...</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">01</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">THU 8-11 AM</td>
                </tr>
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">-</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">-</td>
                    <td style="padding: 10px; border-bottom: 1px solid #ddd;">-</td>
                </tr>
                <tr>
                    <td style="padding: 10px;">-</td>
                    <td style="padding: 10px;">-</td>
                    <td style="padding: 10px;">-</td>
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
    </style>
</div>
@endsection
