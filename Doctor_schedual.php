<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Doctor Schedule</title>
    <link rel="stylesheet" href="style_schedual.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Create Doctor Schedule</h1>
        </header>
        <main>
            <form id="schedule-form" class="form-card">
                <div class="form-group">
                    <label for="doctor-id">Doctor ID:</label>
                    <input type="number" id="doctor-id" placeholder="Enter Doctor ID" required>
                </div>

                <div class="form-group">
                    <label for="doctor-name">Doctor Name:</label>
                    <input type="text" id="doctor-name" placeholder="Enter Doctor Name" required>
                </div>

                <div class="form-group">
                    <label for="availability">Available Days (comma-separated):</label>
                    <input type="text" id="availability" placeholder="e.g., Monday, Wednesday, Friday" required>
                </div>

                <button type="submit" class="btn-primary">Save Schedule</button>
            </form>

            <section class="saved-schedules">
                <h2>Saved Schedules</h2>
                <div id="doctor-list"></div>
            </section>

            <footer>
                <a href="Doctor.php" class="btn-secondary">Back to Home</a>
            </footer>
        </main>
    </div>
    <script src="create_schedule.js"></script>
</body>
</html>
