<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

// Check if user is logged in
if (empty($_SESSION['access_token'])) {
    echo json_encode([
        "status" => 1,
        "message" => "Unauthorized. Please login again"
    ]);
    exit;
}

// Read raw POST data
$postData = json_decode(file_get_contents('php://input'), true);

// Validate input
$categoryId = isset($postData["vehiclecategory"]) ? (int)$postData["vehiclecategory"] : null;
$distance = isset($postData["estimatetripdistance"]) ? (float)$postData["estimatetripdistance"] : null;

if ($categoryId === null || $distance === null) {
    echo json_encode([
        "status" => 2,
        "message" => "Missing required parameters"
    ]);
    exit;
}

// Prepare API request
$apiUrl = "http://yogolitetest.linklanka.lk/Trip/Estimate";
$requestData = json_encode([
    "category_id" => $categoryId,
    "distance" => $distance
]);

// Initialize cURL POST request
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Access-Token: " . $_SESSION['access_token']
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

// Execute request
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

// Handle cURL error
if ($response === false) {
    echo json_encode([
        "status" => 2,
        "message" => "Unable to connect to API",
        "error" => $error
    ]);
    exit;
}

// Decode API response
$apiData = json_decode($response, true);

// Return structured response
if (isset($apiData['status']) && $apiData['status'] === 0) {
    echo json_encode([
        "status" => 0,
        "data" => $apiData
    ]);
} else {
    echo json_encode([
        "status" => 2,
        "message" => $apiData['message'] ?? "Error fetching estimate fare"
    ]);
}
?>
