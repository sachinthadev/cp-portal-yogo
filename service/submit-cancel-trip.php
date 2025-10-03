<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

// --- Check if user is logged in ---
if (empty($_SESSION['access_token'])) {
    echo json_encode([
        "status" => 1,
        "message" => "Unauthorized. Please login again"
    ]);
    exit;
}

// --- Get request body ---
$input = json_decode(file_get_contents("php://input"), true) ?? [];


// --- Map frontend keys to API snake_case keys with fallback ---
$payload = [
    "booking_id"  => $input['booking_id'] ?? '',
    "cancel_reason"      => $input['cancel_reason'] ?? '',
    "remarks"     => $input['remarks'] ?? '',
];


// --- API endpoint ---
$apiUrl = "http://yogolitetest.linklanka.lk/Booking/Cancel";

// --- cURL POST ---
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Access-Token: " . $_SESSION['access_token']
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

// --- Handle cURL error ---
if ($response === false) {
    echo json_encode([
        "status" => 2,
        "message" => "Unable to connect to API",
        "error" => $error
    ]);
    exit;
}

// --- Decode API response ---
$apiData = json_decode($response, true);

// --- Return API response directly ---
echo json_encode([
    "status" => $apiData['status'] ?? 2,
    "message" => $apiData['message'] ?? "Unknown error",
    "data" => $apiData
]);
