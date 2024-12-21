<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

Route::post('/clash-detection', function (Request $request) {
    // Step 1: Fetch timetable data from MySQL
    $timetableData = DB::table('timetable_management')->get();

    // Check if the timetable data is empty
    if ($timetableData->isEmpty()) {
        return response()->json(['error' => 'No timetable data found.'], 404);
    }

    // Step 2: Format the data for the AI API
    $formattedData = $timetableData->map(function ($entry) {
        return [
            'course' => $entry->course_name,
            'room' => $entry->room,
            'time' => $entry->time_slot,
            'lecturer' => $entry->lecturer_name,
        ];
    });

    // Step 3: Prepare the prompt for OpenAI
    $prompt = "Analyze the following timetable data for clashes or conflicts:\n" . json_encode($formattedData, JSON_PRETTY_PRINT);

    try {
        // Step 4: Call OpenAI API
        $apiKey = env('OPENAI_API_KEY');
        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
        ])->post('https://api.openai.com/v1/completions', [
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'max_tokens' => 150,
            'temperature' => 0.7,
        ]);

        // Step 5: Handle the response from OpenAI
        if ($response->failed()) {
            return response()->json(['error' => 'AI request failed: ' . $response->body()], 500);
        }

        $result = $response->json();
        $clashes = $result['choices'][0]['text'] ?? 'No clashes detected.';

        // Step 6: Return the AI result
        return response()->json(['clashes' => $clashes]);

    } catch (\Exception $e) {
        // Step 7: Handle any errors
        return response()->json(['error' => 'Failed to process request: ' . $e->getMessage()], 500);
    }
});
