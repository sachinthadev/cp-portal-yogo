<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

// Require session
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
$apiUrl = "http://yogolitetest.linklanka.lk/Company/CreditLimit";

// cURL GET
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Access-Token: " . $_SESSION['access_token']  // header key as per new API
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

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

$apiData = json_decode($response, true);

// Check unauthorized
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

// Return data
echo json_encode([
    "status" => 0,
    "data" => [
        "status" => 0,
        "data" => $apiData
    ]
]);
