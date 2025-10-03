<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

// Check session
if (empty($_SESSION['access_token'])) {
    echo json_encode([
        "status" => 1,
        "message" => "Unauthorized. Please login again."
    ]);
    exit;
}

// Get endpoint
$endpoint = $_GET['endpoint'] ?? null;
if (!$endpoint) {
    echo json_encode(["status" => 1, "message" => "Missing endpoint"]);
    exit;
}

$API_BASE_URL = "http://yogolitetest.linklanka.lk/";
$apiUrl = $API_BASE_URL . ltrim($endpoint, "/");

// Forward POST data
$inputData = file_get_contents("php://input");

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    curl_setopt($ch, CURLOPT_POSTFIELDS, $inputData);
}

// Pass headers including access token
$headers = [
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer " . $_SESSION['access_token']
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($response === false) {
    echo json_encode(["status" => 1, "message" => "Unable to connect to API", "error" => $error]);
} else {
    echo $response;
}
