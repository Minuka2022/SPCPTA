<?php
// timerUpdate.php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_timer'])) {
        $hours = isset($_POST['hours']) ? intval($_POST['hours']) : 0;
        $minutes = isset($_POST['minutes']) ? intval($_POST['minutes']) : 0;
        $seconds = isset($_POST['seconds']) ? intval($_POST['seconds']) : 0;

        // Validate the inputs
        if ($hours >= 0 && $minutes >= 0 && $seconds >= 0) {
            // Calculate the new end time
            $currentTime = time(); // Current timestamp in seconds
            $newEndTime = $currentTime + ($hours * 3600 + $minutes * 60 + $seconds); // Future timestamp
            
            // Save the new end time in `timer.json`
            file_put_contents('timer.json', json_encode(['end_time' => $newEndTime]));
            $message = "Timer updated successfully!";
        } else {
            $message = "Invalid time values.";
        }
    }
} else {
    $message = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Timer</title>
    <style>
        /* Your existing CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="number"] {
            padding: 8px;
            width: calc(100% - 16px);
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 16px;
        }

        button {
            background-color: #007BFF;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 20px;
            color: #333;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }

        #live-timer {
            font-size: 48px;
            color: #007BFF;
            margin-top: 20px;
        }

        #timer-fields {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .timer-field {
            font-size: 24px;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Countdown Timer</h1>
        <form method="POST" action="timerUpdate.php">
            <label for="hours">Hours:</label>
            <input type="number" id="hours" name="hours" min="0" required>

            <label for="minutes">Minutes:</label>
            <input type="number" id="minutes" name="minutes" min="0" required>

            <label for="seconds">Seconds:</label>
            <input type="number" id="seconds" name="seconds" min="0" required>

            <button type="submit" name="update_timer">Update Timer</button>
        </form>
        
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <a href="index.php">Back to Home</a>

        <!-- Timer Display -->
        <div id="live-timer">
            <div id="timer-fields">
                <div class="timer-field" id="hours-field">00</div>: 
                <div class="timer-field" id="minutes-field">00</div>: 
                <div class="timer-field" id="seconds-field">00</div>
            </div>
        </div>
    </div>

    <script>
        let countdownFunction;
        let countdownDate;

        // Function to fetch timer value from timer.json
        function fetchCountdownTime() {
            return fetch('timer.json', { cache: "no-store" })
                .then(response => response.json())
                .then(data => {
                    if (data && data.end_time) {
                        return data.end_time * 1000; // Return time in milliseconds
                    } else {
                        console.error('Invalid data in timer.json');
                        return null;
                    }
                })
                .catch(error => {
                    console.error('Error fetching timer.json:', error);
                    return null;
                });
        }

        // Function to start the countdown
        function startCountdown() {
            fetchCountdownTime().then(countdownMilliseconds => {
                if (!countdownMilliseconds) return;

                countdownDate = countdownMilliseconds;

                countdownFunction = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = countdownDate - now;

                    // Calculate hours, minutes, and seconds
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Add leading zeros to hours, minutes, and seconds
                    const formattedHours = hours < 10 ? "0" + hours : hours;
                    const formattedMinutes = minutes < 10 ? "0" + minutes : minutes;
                    const formattedSeconds = seconds < 10 ? "0" + seconds : seconds;

                    // Display the result in the format hh:mm:ss
                    document.getElementById("hours-field").textContent = formattedHours;
                    document.getElementById("minutes-field").textContent = formattedMinutes;
                    document.getElementById("seconds-field").textContent = formattedSeconds;

                    // If the countdown is finished
                    if (distance < 0) {
                        clearInterval(countdownFunction);
                        document.getElementById("hours-field").textContent = "00";
                        document.getElementById("minutes-field").textContent = "00";
                        document.getElementById("seconds-field").textContent = "00";
                    }
                }, 1000);
            });
        }

        // Initialize the countdown when the page loads
        startCountdown();
    </script>
</body>
</html>
