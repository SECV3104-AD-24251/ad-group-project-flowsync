<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenAIController extends Controller
{
    public function detectClashes(Request $request)
    {
        $apiKey = env('OPENAI_API_KEY'); // Make sure to set this in your .env file

        // Prepare the data to send to OpenAI
        $timetableEntries = $request->input('entries'); // Expecting an array of entries

        // Create a prompt for OpenAI
        $prompt = "Given the following timetable entries, identify any clashes:\n";
        foreach ($timetableEntries as $entry) {
            $prompt .= "Course Code: {$entry['course_code']}, Course Name: {$entry['course_name']}, Section: {$entry['section']}, Time Slot: {$entry['time_slot']}\n";
        }

        // Call OpenAI API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo', // or any other model you want to use
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return response()->json($response->json());
    }
}