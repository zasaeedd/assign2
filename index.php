<?php
//API endpoint URL
$apiUrl = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

//Fetch data from API
$response = file_get_contents($apiUrl);

//Check if the request was successful
if ($response === false) {
    $error = error_get_last();
    echo "Error fetching data: " . $error['message'];
    exit;
}

//Parse the JSON response
$data = json_decode($response, true); // true to get an associative array

//Check for JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON Parsing Error: " . json_last_error_msg();
    exit;
}

//Display the parsed data (for testing purposes, delete later)
echo "<pre>";
print_r($data);
echo "</pre>";
?>