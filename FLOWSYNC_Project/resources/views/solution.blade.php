<x-app-layout>
    <h1 class="text-2xl font-bold">Solution Page</h1>
    <p class="mt-4 text-lg">This is where the solution details will be displayed.</p>

    {{-- Solution Details Section --}}
    <div id="solution" class="mt-6 p-4 bg-gray-100 rounded shadow">
        <p class="text-lg font-medium">Generated Solution:</p>
        <div id="openai-solution" class="mt-2 text-gray-700">
            {{-- This will display the solution from OpenAI --}}
            <p>Loading solution...</p>
        </div>
    </div>

    {{-- Back to Timetable Button --}}
    <a href="{{ url('/timetable') }}" class="mt-4 inline-block text-blue-500 hover:underline">
        Back to Timetable
    </a>
</x-app-layout>
<x-app-layout>
    <h1 class="text-2xl font-bold">Solution Page</h1>
    <p class="mt-4 text-lg">This is where the solution details will be displayed.</p>

    {{-- Solution Details Section --}}
    <div id="solution" class="mt-6 p-4 bg-gray-100 rounded shadow">
        <p class="text-lg font-medium">Generated Solution:</p>
        <div id="openai-solution" class="mt-2 text-gray-700">
            {{-- This will display the solution from OpenAI --}}
            <p>Loading solution...</p>
        </div>
    </div>

    {{-- Back to Timetable Button --}}
    <a href="{{ url('/timetable') }}" class="mt-4 inline-block text-blue-500 hover:underline">
        Back to Timetable
    </a>

    {{-- Script to Fetch Solution --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Example timetable data for demonstration
            const timetableData = [
                {
                    course_name: "SECV3104",
                    instructor_name: "Dr. Smith",
                    room_name: "Room A",
                    section: "Section 1",
                    day_of_week: "Monday",
                    start_time: "09:00:00",
                    end_time: "10:30:00"
                },
                {
                    course_name: "SECV3104",
                    instructor_name: "Dr. Smith",
                    room_name: "Room A",
                    section: "Section 2",
                    day_of_week: "Monday",
                    start_time: "11:00:00",
                    end_time: "12:30:00"
                }
            ];

            // Fetch solution from the backend
            fetch('/generate-solution', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ timetable_data: timetableData })
            })
            .then(response => response.json())
            .then(data => {
                const solutionDiv = document.getElementById('openai-solution');
                if (data.solution) {
                    solutionDiv.innerHTML = `<p>${data.solution}</p>`;
                } else {
                    solutionDiv.innerHTML = `<p class="text-red-500">${data.error}</p>`;
                }
            })
            .catch(error => {
                document.getElementById('openai-solution').innerHTML = 
                    `<p class="text-red-500">Error fetching solution: ${error.message}</p>`;
            });
        });
    </script>
</x-app-layout>

