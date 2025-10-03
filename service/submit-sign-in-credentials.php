<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");

// Get POST data
$postData = json_decode(file_get_contents('php://input'), true);

if (empty($postData['email']) || empty($postData['password'])) {
    echo json_encode([
        "status" => 1,
        "data" => ["status" => 1, "message" => "Email and password are required"]
    ]);
    exit;
}

// API endpoint
$apiUrl = "http://yogolitetest.linklanka.lk/CompanyEmployee/SignIn";

// cURL POST
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($response === false) {
    echo json_encode([
        "status" => 1,
        "data" => ["status" => 1, "message" => "Unable to connect to login service", "error" => $error]
    ]);
    exit;
}

$data = json_decode($response, true);

// ✅ Successful login → store in SESSION
if (isset($data['status']) && $data['status'] == 0 && !empty($data['access_token'])) {
    $_SESSION['access_token'] = $data['access_token'];
    $_SESSION['company_id']   = $data['company_id'] ;
    $_SESSION['employee_id']  = $data['employee_id'];
    $_SESSION['company_name']  = $data['company_name'];
    $_SESSION['employee_name']  = $data['employee_name'];
    $_SESSION['email']        = $postData['email'];  
    $_SESSION['logged_in']    = true;

    echo json_encode([
        "status" => 0,
        "data" => ["status" => 0, "message" => "Login successful", "session" => $_SESSION]
    ]);
} else {
    // ❌ Login failed → destroy session
    session_destroy();
    echo json_encode([
        "status" => 1,
        "data" => [
            "status" => 1,
            "message" => $data['message'] ?? "Invalid email or password"
        ]
    ]);
}
