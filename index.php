<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// API endpoint URL
$apiUrl = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data from API
$response = file_get_contents($apiUrl);

// Check if the request was successful
if ($response === false) {
    $error = error_get_last();
    echo "Error fetching data: " . $error['message'];
    exit;
}

// Parse the JSON response
$data = json_decode($response, true); // true to get an associative array

// Check for JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON Parsing Error: " . json_last_error_msg();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment Data</title>
    <!-- Pico CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picocss@1.5.7/dist/pico.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Student Enrollment Data - Bachelor Programs</h1>

        <!-- Table to display the data -->
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>The Programs</th>
                    <th>Nationality</th>
                    <th>College</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if 'results' key exists and contains data
                if (isset($data['results']) && !empty($data['results'])) {
                    // Loop through the data and display each record in a table row
                    foreach ($data['results'] as $record) {
                        // Output each record's details as table rows
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($record['year']) . "</td>";
                        echo "<td>" . htmlspecialchars($record['semester']) . "</td>";
                        echo "<td>" . htmlspecialchars($record["the_programs"]) . "</td>";
                        echo "<td>" . htmlspecialchars($record['nationality']) . "</td>";
                        echo "<td>" . htmlspecialchars($record['colleges']) . "</td>";
                        echo "<td>" . htmlspecialchars($record['number_of_students']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // If no data found, display a message
                    echo "<tr><td colspan='5'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
