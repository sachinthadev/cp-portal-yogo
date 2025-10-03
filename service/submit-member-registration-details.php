<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

// --- Authentication check ---
if (empty($_SESSION['access_token'])) {
    echo json_encode([
        "status" => 1,
        "message" => "Unauthorized. Please login again"
    ]);
    exit;
}

// --- Read JSON input from frontend ---
$input = json_decode(file_get_contents("php://input"), true);

$employeeId    = $input['employee_id'] ?? '';
$departmentId  = $input['department_id'] ?? '';
$branchId      = $input['branch_id'] ?? '';
$employeeNo    = $input['employee_no'] ?? '';
$title         = $input['title'] ?? '';
$employeeName  = $input['employee_name'] ?? '';
$callName      = $input['call_name'] ?? '';
$phoneNumber   = $input['phone_no'] ?? '';
$email         = $input['email'] ?? '';
$userType      = $input['user_type'] ?? '';
$creditLimit   = $input['credit_limit'] ?? '';
$active        = filter_var($input['active'] ?? false, FILTER_VALIDATE_BOOLEAN);
$signup        = filter_var($input['signup'] ?? false, FILTER_VALIDATE_BOOLEAN);

// --- External API URL ---
$apiUrl = "http://yogolitetest.linklanka.lk/CompanyEmployee/Save";

// --- Prepare request data ---
$requestData = json_encode([
    "employee_id"   => $employeeId,
    "department_id" => $departmentId,
    "branch_id"     => $branchId,
    "employee_no"   => $employeeNo,
    "title"         => $title,
    "employee_name" => $employeeName,
    "call_name"     => $callName,
    "phone_no"      => $phoneNumber,
    "email"         => $email,
    "user_type"     => $userType,
    "credit_limit"  => (float)$creditLimit,
    "active"        => $active,
    "signup"        => $signup
]);

// --- Initialize cURL ---
$ch = curl_init($apiUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $requestData,
    CURLOPT_HTTPHEADER     => [
        "Content-Type: application/json",
        "Access-Token: " . $_SESSION['access_token']
    ],
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 0
]);

$response = curl_exec($ch);
$error    = curl_error($ch);
curl_close($ch);

// --- Handle connection error ---
if ($response === false) {
    echo json_encode([
        "status" => 2,
        "message" => "Unable to connect to API",
        "error" => $error
    ]);
    exit;
}

// --- Parse external API response ---
$apiData = json_decode($response, true);

// --- Final response back to JS ---
echo json_encode([
    "status"  => $apiData['status'] ?? 2,
    "message" => $apiData['message'] ?? "Unknown error",
    "data"    => $apiData['data'] ?? $apiData
]);
