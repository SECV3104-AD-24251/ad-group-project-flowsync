<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shared Timetable Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
        <h1 class="text-2xl font-bold mb-6 text-center">Shared Timetable Form</h1>
        <form action="submit_shared_timetable.php" method="POST" class="space-y-4">
            <!-- Lecturer Details -->
            <div>
                <label for="lecturer_name" class="block text-sm font-medium text-gray-700">Lecturer Name</label>
                <input 
                    type="text" 
                    id="lecturer_name" 
                    name="lecturer_name" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                    placeholder="Enter lecturer name" 
                    required
                >
            </div>

            <!-- Student Details -->
            <div>
                <label for="student_name" class="block text-sm font-medium text-gray-700">Student Name</label>
                <input 
                    type="text" 
                    id="student_name" 
                    name="student_name" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                    placeholder="Enter student name" 
                    required
                >
            </div>

            <!-- Timetable Entry -->
            <div>
                <label for="time_slot" class="block text-sm font-medium text-gray-700">Time Slot</label>
                <input 
                    type="text" 
                    id="time_slot" 
                    name="time_slot" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                    placeholder="e.g., Monday 9:00 AM - 10:00 AM" 
                    required
                >
            </div>

            <!-- Room Details -->
            <div>
                <label for="room" class="block text-sm font-medium text-gray-700">Room</label>
                <input 
                    type="text" 
                    id="room" 
                    name="room" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                    placeholder="Enter room number or name" 
                    required
                >
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button 
                    type="submit" 
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Submit Timetable
                </button>
            </div>
        </form>
    </div>
</body>
</html>
