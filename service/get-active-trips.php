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
$apiUrl = "http://yogolitetest.linklanka.lk/CompanyBooking/List";

// Request body for GET
$payload = json_encode([
    "type" => 1
]);

// cURL GET with body
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); // force GET
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); // attach body
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Access-Token: " . $_SESSION['access_token'],
    "Content-Length: " . strlen($payload)
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

// Unauthorized check
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

// Return formatted response
echo json_encode([
    "status" => 0,
    "data" => [
        "status" => 0,
        "data" => $apiData
    ]
]);
