@extends('layouts.student') <!-- Extends the 'app' layout template -->

@section('content') <!-- Section where content is injected into the 'app' layout -->

<div class="container mx-auto p-6 bg-white rounded shadow-lg">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Solution</h1>
    </div>

    <!-- Analysis Form -->
    <div class="bg-gray-100 p-4 rounded mb-6">
        <p class="text-gray-600 mb-4">
            The system will automatically analyze timetable data stored in the database and provide insights.
        </p>
        <form id="aiForm">
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 transition duration-200">
                Analyze Timetable
            </button>
        </form>
    </div>

    <!-- Results Section -->
    <div id="result" class="bg-gray-50 p-4 rounded shadow">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">AI Analysis Result:</h2>
        <div id="aiResponse" class="text-gray-600">
            <!-- AI analysis results will be dynamically injected here -->
        </div>
    </div>
</div>

@endsection

@push('scripts') <!-- Section for page-specific JavaScript -->
<script>
    document.getElementById('aiForm').addEventListener('submit', async (e) => {
        e.preventDefault(); // Prevent the form from submitting normally and reloading the page

        const aiResponseContainer = document.getElementById('aiResponse');
        aiResponseContainer.innerHTML = `<p class="text-blue-500">Analyzing... Please wait.</p>`; // Show loading message

        try {
            const response = await fetch('/generate-solution', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
                },
                body: JSON.stringify({}) // Empty body, backend handles fetching the data
            });

            const result = await response.json();
            console.log(result); // Log the response for debugging

            if (response.ok) {
                if (result.clashes && result.clashes.length > 0) {
                    aiResponseContainer.innerHTML = `
                        <p><strong>Detected Clashes:</strong></p>
                        <ul class="list-disc pl-6">
                            ${result.clashes.map(clash => `<li>${clash}</li>`).join('')}
                        </ul>
                    `;
                } else {
                    aiResponseContainer.innerHTML = `<p class="text-green-500">No clashes detected.</p>`;
                }
            } else {
                aiResponseContainer.innerHTML = `<p class="text-red-500">Error: ${result.error || 'Unknown error occurred.'}</p>`;
            }
        } catch (error) {
            console.error('Error:', error); // Log any JavaScript errors
            aiResponseContainer.innerHTML = `<p class="text-red-500">Failed to fetch AI response: ${error.message}</p>`;
        }
    });
</script>
@endpush
