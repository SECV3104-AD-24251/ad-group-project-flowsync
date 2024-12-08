namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class SolutionController extends Controller
{
    public function generateSolution(Request $request)
    {
        $timetableData = $request->input('timetable_data', []);

        if (empty($timetableData)) {
            return response()->json(['error' => 'No timetable data provided.'], 400);
        }

        try {
            $client = OpenAI::client(env('OPENAI_API_KEY'));

            $prompt = "Detect clashes in the following timetable data:\n" . json_encode($timetableData, JSON_PRETTY_PRINT);

            $response = $client->completions()->create([
                'model' => 'text-davinci-003',
                'prompt' => $prompt,
                'max_tokens' => 200,
            ]);

            $result = trim($response['choices'][0]['text']);
            return response()->json(['solution' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to generate solution: ' . $e->getMessage()], 500);
        }
    }
}
