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

// OpenAI for Overlapping Schedule
Route::post('/clash-detection', function (Request $request) {
    // Validate timetable data
    $request->validate([
        'timetable_data' => 'required|array',
    ]);

    $timetableData = $request->input('timetable_data');
    
    if (empty($timetableData)) {
        return response()->json(['error' => 'No timetable data provided.'], 400);
    }

    // Interact with OpenAI API
    $client = \OpenAI::client(env('OPENAI_API_KEY'));

    // Preparing the Prompt
    $prompt = "Detect timetable clashes in the following data:\n" . json_encode($timetableData, JSON_PRETTY_PRINT);

    try {
        // Sending a Request to OpenAI
        $response = $client->completions()->create([
            'model' => 'text-davinci-003',              //AI model that dvanced and can handle natural language tasks
            'prompt' => $prompt,                        //Sends the data along with instructions to detect timetable clashes
            'max_tokens' => 150,                        //Limits the number of tokens (words) the AI can return in the respons
        ]);

        // Processing the Response
        $result = trim($response['choices'][0]['text']);
        return response()->json(['clashes' => $result]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to process request: ' . $e->getMessage()], 500);
    }
});
