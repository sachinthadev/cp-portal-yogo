<?php
// submit-forget-password-1.php
session_start();
header("Content-Type: application/json; charset=UTF-8");

$input = json_decode(file_get_contents("php://input"), true);
$email = trim($input['email'] ?? '');
$phoneNumber = trim($input['phone_no'] ?? '');

if (!$email || !$phoneNumber) {
    echo json_encode([
        "status" => 2,
        "message" => "All fields are required."
    ]);
    exit;
}

$apiUrl = "http://yogolitetest.linklanka.lk/CompanyEmployee/RecoverPassword";

$requestData = json_encode([
    "email" => $email,
    "phone_no" => $phoneNumber
]);

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Access-Token: " . ($_SESSION['access_token'] ?? '')
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$response = curl_exec($ch);
$curlError = curl_error($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($response === false) {
    echo json_encode([
        "status" => 2,
        "message" => "Unable to connect to API",
        "error" => $curlError
    ]);
    exit;
}

$apiData = json_decode($response, true);
if ($apiData === null) {
    echo json_encode([
        "status" => 2,
        "message" => "Invalid JSON response from API",
        "raw" => $response
    ]);
    exit;
}

echo json_encode([
    "status" => $apiData['status'] ?? 2,
    "message" => $apiData['message'] ?? "Unknown response from API",
    "data" => $apiData
]);
