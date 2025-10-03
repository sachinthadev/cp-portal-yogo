<?php
session_start();
// echo "Current session token: " . $_SESSION['access_token'];
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

// Get params
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date   = isset($_GET['end_date']) ? $_GET['end_date'] : null;
$type       = isset($_GET['type']) ? $_GET['type'] : null;

if (!$start_date || !$end_date || !$type) {
    echo json_encode([
        "status" => 0,
        "data" => [
            "status" => 2,
            "message" => "Missing start_date, end_date or type"
        ]
    ]);
    exit;
}

// ✅ Correct external API endpoint
$apiUrl = "http://yogolitetest.linklanka.lk/CompanyBooking/List?type={$type}&start_date={$start_date}&end_date={$end_date}";

// Init cURL
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

// Send headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Access-Token: " . $_SESSION['access_token'],
    "type: " . $type  // if API also needs type in header
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

// Execute
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

// Check for unauthorized
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

// Success
echo json_encode([
    "status" => 0,
    "data" => [
        "status" => 0,
        "data" => $apiData
    ]
]);
