<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solution Page</title>
    <!-- Include your global CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- Common Header -->
    <header class="header">
        <nav class="navbar">
            <a href="/" class="logo">MyApp</a>
            <ul class="nav-links">
                <li><a href="/calendar">Calendar</a></li>
                <li><a href="/timetable">Timetable</a></li>
                <li><a href="/solution" class="active">Solution</a></li>
                <li><a href="/helpCenter">Help Center</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <h1>Solution Page</h1>
            <!-- Form to trigger AI analysis -->
            <form id="aiForm" class="form">
                <p>The system will automatically analyze timetable data stored in the database.</p>
                <button type="submit" class="btn-primary">Analyze Timetable</button>
            </form>

            <!-- Section to display AI analysis result -->
            <div id="result" class="result-section">
                <h2>AI Analysis Result:</h2>
                <div id="aiResponse" class="ai-response"></div>
            </div>
        </div>
    </main>

    <!-- Common Footer -->
    <footer class="footer">
        <p>&copy; 2024 MyApp. All rights reserved.</p>
    </footer>

    <!-- JavaScript -->
    <script>
        document.getElementById('aiForm').addEventListener('submit', async (e) => {
            e.preventDefault(); // Prevent form from reloading the page

            try {
                const response = await fetch('/generate-solution', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const result = await response.json();

                const aiResponseContainer = document.getElementById('aiResponse');

                if (response.ok) {
                    // Check if the AI returned any clashes
                    if (result.clashes) {
                        // Format and display the clashes and suggestions
                        aiResponseContainer.innerHTML = `
                            <p><strong>Detected Clashes:</strong></p>
                            <ul>
                                ${result.clashes.map(clash => `<li>${clash}</li>`).join('')}
                            </ul>
                            <p><strong>Suggestions:</strong></p>
                            <ul>
                                ${result.suggestions ? result.suggestions.map(suggestion => `<li>${suggestion}</li>`).join('') : '<li>No suggestions available.</li>'}
                            </ul>
                        `;
                    } else {
                        aiResponseContainer.innerHTML = `<p>No clashes detected.</p>`;
                    }
                } else {
                    aiResponseContainer.innerHTML = `
                        <p style="color: red;">Error processing the request: ${result.error || 'Unknown error'}</p>
                    `;
                }
            } catch (error) {
                document.getElementById('aiResponse').innerHTML = `
                    <p style="color: red;">Failed to fetch AI response: ${error.message}</p>
                `;
            }
        });
    </script>
</body>
</html>
