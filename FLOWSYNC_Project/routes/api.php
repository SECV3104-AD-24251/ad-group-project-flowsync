<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/clash-detection', function (Request $request) {
    // Validate the uploaded file
    $request->validate([
        'file' => 'required|file|mimes:json',
    ]);

    // Read the JSON file
    $file = $request->file('file');
    $timetableData = json_decode(file_get_contents($file->getRealPath()), true);

    if (!$timetableData) {
        return response()->json(['error' => 'Invalid JSON structure.'], 400);
    }

    // Interact with OpenAI API
    $client = \OpenAI::client(env('OPENAI_API_KEY'));

    $prompt = "Detect timetable clashes in the following data:\n" . json_encode($timetableData, JSON_PRETTY_PRINT);

    try {
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'max_tokens' => 150,
        ]);

        $result = trim($response['choices'][0]['text']);

        return response()->json(['clashes' => $result]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to process request: ' . $e->getMessage()], 500);
    }
});
