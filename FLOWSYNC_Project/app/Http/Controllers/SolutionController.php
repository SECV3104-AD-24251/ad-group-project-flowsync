<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SolutionController extends Controller
{
    public function generateSolution(Request $request)
    {
        try {
            // Fetch timetable data from MySQL
            $timetableData = DB::table('timetable_entries')->get();

            // Format the data
            $formattedData = $timetableData->map(function ($entry) {
                return [
                    'course_code' => $entry->course_code,
                    'course_name' => $entry->course_name,
                    'section' => $entry->section,
                    'time_slot' => $entry->time_slot,
                    'lecturer_name' => $entry->lecturer_name,
                ];
            })->toArray();

            $prompt = "Analyze the following timetable for potential conflicts: " . json_encode($formattedData);

            // Send data to OpenAI
            $client = new Client();
            $response = $client->post('https://api.openai.com/v1/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'text-davinci-003',
                    'prompt' => $prompt,
                    'max_tokens' => 150,
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);

            // Return the solution
            return response()->json(['solution' => $responseData['choices'][0]['text'] ?? 'No solution provided.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
