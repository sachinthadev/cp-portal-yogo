<?php
session_start();

// Detect if request is API/AJAX
$isApiRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if (empty($_SESSION['logged_in']) || empty($_SESSION['access_token'])) {
    if ($isApiRequest) {
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode([
            "status" => 1,
            "data" => [
                "status" => 1,
                "message" => "Unauthorized. Please login again."
            ]
        ]);
    } else {
        header("Location: ../view/sign-in.php");
    }
    exit;
}
