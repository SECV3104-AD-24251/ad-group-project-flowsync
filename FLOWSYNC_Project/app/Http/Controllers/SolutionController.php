<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SolutionController extends Controller
{
    public function detectClashes(Request $request)
    {
        try {
            // Step 1: Fetch data from MySQL
            $timetableData = DB::table('timetable_management')->get();

            if ($timetableData->isEmpty()) {
                return response()->json(['error' => 'No timetable data found.'], 404);
            }

            // Step 2: Format the data
            $formattedData = $timetableData->map(function ($entry) {
                return [
                    'course' => $entry->course_name,
                    'room' => $entry->room,
                    'time' => $entry->time_slot,
                    'lecturer' => $entry->lecturer_name,
                ];
            });

            // Step 3: Call AI API
            $apiKey = env('OPENAI_API_KEY');
            $response = Http::withHeaders([
                'Authorization' => "Bearer $apiKey",
            ])->post('https://api.openai.com/v1/completions', [
                'model' => 'text-davinci-003',
                'prompt' => "Analyze the following timetable data for clashes:\n" 
                    . json_encode($formattedData, JSON_PRETTY_PRINT),
                'max_tokens' => 150,
                'temperature' => 0.7,
            ]);

            // Step 4: Parse the AI response
            if ($response->failed()) {
                throw new \Exception('AI request failed: ' . $response->body());
            }

            $result = $response->json();
            $clashes = $result['choices'][0]['text'] ?? 'No clashes detected.';

            // Step 5: Return the result
            return response()->json(['clashes' => $clashes], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to process request: ' . $e->getMessage()], 500);
        }
    }
}
