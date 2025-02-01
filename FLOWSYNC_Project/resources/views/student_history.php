<style>
.container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 30px;
}

h2 {
    text-align: center;
    font-size: 28px;
    color: #333;
    margin-bottom: 30px;
}

.btn-secondary {
    display: inline-block;
    margin-bottom: 20px;
    font-size: 14px;
    padding: 10px 20px;
    color: #fff;
    background-color: #4CAF50;
    border-radius: 5px;
    text-decoration: none;
}

.event-history {
    background-color: #f9f9f9;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.history-item {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-left: 6px solid #4CAF50;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.history-header {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    font-weight: bold;
    color: #333;
}

.timestamp {
    color: #777;
    font-style: italic;
}

.user {
    color: #00796B;
}

.change-action {
    font-size: 16px;
    font-weight: 600;
    margin: 15px 0;
    color: #333;
}

.change-details {
    margin: 10px 0;
}

.change-details p {
    font-size: 14px;
    margin: 8px 0;
    color: #555;
}

.old-value, .new-value {
    padding: 12px;
    border-radius: 5px;
    font-size: 14px;
    margin-bottom: 10px;
}

.old-value {
    background-color: #f4f4f4;
    border: 1px solid #ddd;
}

.new-value {
    background-color: #e7f5e6;
    border: 1px solid #4CAF50;
}

.history-divider {
    margin-top: 20px;
    border-top: 2px solid #ddd;
    border-bottom: 2px solid #ddd;
}
</style>

<div class="container">
    <h2>Event Change History</h2>
    <a href="{{ route('student-calendar') }}" class="btn btn-secondary">⬅ Back to Calendar</a>

    <div id="event-history" class="event-history"></div>
</div>

<!-- Load event history via AJAX -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch("{{ route('student-calendar.history.data') }}")
    .then(response => response.json())
    .then(data => {
        const historyContainer = document.getElementById("event-history");
        if (data.length === 0) {
            historyContainer.innerHTML = "<p>No history recorded.</p>";
            return;
        }

        let historyHTML = "";
        data.forEach(history => {
            historyHTML += `
                <div class="history-item">
                    <div class="history-header">
                        <span class="user">${history.user ? history.user.name : "Unknown User"}</span>
                        <span class="timestamp">${new Date(history.created_at).toLocaleString()}</span>
                    </div>
                    <p class="change-action"><strong>${history.action.toUpperCase()}</strong> an event.</p>
                    ${history.old_value ? `
                        <div class="change-details">
                            <p><strong>Old Values:</strong></p>
                            <div class="old-value">${formatJSON(history.old_value)}</div>
                            <p><strong>New Values:</strong></p>
                            <div class="new-value">${formatJSON(history.new_value)}</div>
                        </div>
                    ` : ""}
                </div><hr class="history-divider">`;
        });

        historyContainer.innerHTML = historyHTML;
    });

    function formatJSON(jsonData) {
        let obj = JSON.parse(jsonData);
        return Object.keys(obj).map(key => `<p><strong>${key}:</strong> ${obj[key]}</p>`).join("");
    }
});
</script>

