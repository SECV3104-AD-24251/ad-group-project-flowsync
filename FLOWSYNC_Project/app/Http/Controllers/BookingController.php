<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use App\Models\Booking; // Ensure the Booking model is used

class BookingController extends Controller
{
    // Handle the slot booking
    public function bookSlot(Request $request)
    {
        // Log the incoming data for debugging
        Log::info("Received booking request:", $request->all());

        // Validate incoming request data
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'time' => 'required|date_format:H:i', 
            'duration' => 'required|integer|min:1', 
        ]);

        try {
            // Save the booking to the database
            $booking = Booking::create([
                'subject' => $validated['subject'],
                'time' => $validated['time'],
                'duration' => $validated['duration'],
            ]);

            Log::info("Booking successful: ", $booking->toArray());

            return response()->json([
                'status' => 'success',
                'message' => 'Slot booked successfully.',
                'data' => $booking
            ], 201); // 201 = Created status

        } catch (\Exception $e) {
            // Log any exception errors
            Log::error("Booking error: " . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while booking the slot.'
            ], 500); // 500 = Server error
        }
    }
}
