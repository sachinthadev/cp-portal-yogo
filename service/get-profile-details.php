<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

// Check if user is logged in
if (empty($_SESSION['access_token'])) {
    echo json_encode([
        "status" => 0,
        "data" => [
            "status" => 1,
            "message" => "Unauthorized. Please login again."
        ]
    ]);
    exit;
}

// API endpoint
$apiUrl = "http://yogolitetest.linklanka.lk/CompanyEmployee/Detail";

// Initialize cURL GET request
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Access-Token: " . $_SESSION['access_token'] // Pass access token in header
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

// Execute request
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

// Handle cURL errors
if ($response === false) {
    echo json_encode([
        "status" => 0,
        "data" => [
            "status" => 2,
            "message" => "Unable to connect to API",
            "error" => $error
        ]
    ]);
    exit;
}

// Decode API response
$apiData = json_decode($response, true);

// Handle unauthorized response
if (isset($apiData['status']) && $apiData['status'] == 1 && isset($apiData['message']) && $apiData['message'] === "Unauthorized") {
    echo json_encode([
        "status" => 0,
        "data" => [
            "status" => 1,
            "message" => "Unauthorized. Please login again."
        ]
    ]);
    exit;
}

// Return API data in consistent JSON structure
echo json_encode([
    "status" => 0,
    "data" => [
        "status" => 0,
        "data" => $apiData
    ]
]);
