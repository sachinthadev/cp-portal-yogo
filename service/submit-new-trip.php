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

// --- Auto-fill missing company_id / employee_id from session ---
$company_id  = $_SESSION['company_id'] ?? '';
$employee_id = $_SESSION['employee_id'] ?? '';

// --- Map frontend keys to API snake_case keys with fallback ---
$payload = [
    "passenger_phone_no"  => $input['passenger_phone_no'] ?? '',
    "passenger_name"      => $input['passenger_name'] ?? '',
    "pickup_location"     => $input['pickup_location'] ?? '',
    "pickup_lat"          => $input['pickup_lat'] ?? '',
    "pickup_lng"          => $input['pickup_lng'] ?? '',
    "drop_location"       => $input['drop_location'] ?? '',
    "drop_lat"            => $input['drop_lat'] ?? '',
    "drop_lng"            => $input['drop_lng'] ?? '',
    "taxi_category_id"    => $input['taxi_category_id'] ?? '',
    "required_time"       => $input['required_time'] ?? '',
    "estimate_id"         => $input['estimate_id'] ?? '',
    "company_id"          => $input['company_id'] ?? $company_id,
    "branch_id"           => $input['branch_id'] ?? '',
    "department_id"       => $input['department_id'] ?? '',
    "employee_id"         => $input['employee_id'] ?? $employee_id,
    "remarks"             => $input['remarks'] ?? '',
    "driver_remarks"      => $input['driver_remarks'] ?? ''
];

// --- Debug logging ---
$logData = "[".date('Y-m-d H:i:s')."] REQUEST: ".json_encode($payload).PHP_EOL;
file_put_contents(__DIR__.'/trip_debug.log', $logData, FILE_APPEND);

// --- API endpoint ---
$apiUrl = "http://yogolitetest.linklanka.lk/CompanyBooking/NewRequest";

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
    $logData = "[".date('Y-m-d H:i:s')."] CURL ERROR: ".$error.PHP_EOL;
    file_put_contents(__DIR__.'/trip_debug.log', $logData, FILE_APPEND);

    echo json_encode([
        "status" => 2,
        "message" => "Unable to connect to API",
        "error" => $error
    ]);
    exit;
}

// --- Decode API response ---
$apiData = json_decode($response, true);

// --- Log API response ---
$logData = "[".date('Y-m-d H:i:s')."] RESPONSE: ".json_encode($apiData).PHP_EOL;
file_put_contents(__DIR__.'/trip_debug.log', $logData, FILE_APPEND);

// --- Return API response directly ---
echo json_encode([
    "status" => $apiData['status'] ?? 2,
    "message" => $apiData['message'] ?? "Unknown error",
    "data" => $apiData
]);
