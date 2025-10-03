<?php
session_start();
include_once('../util/services.php');
$confimId = null;

if (isset($_GET['id'])) {
    $confimId = $_GET['id'];
}


/**
 *
 */


$postData = json_decode(file_get_contents('php://input'), true);

$requestData = array(
    "guid" => $confimId,
);
//echo json_encode($requestData);
$data = json_decode(post($requestData, "corpuser/validationDo"), true);
//echo json_encode($data);
if (array_key_exists('Error', $data)) {
    session_destroy();
    header("Location: ../view/sign-in.php");
} else {
    if ($data['state']) {

        $_SESSION["tempYogoEmpId"] = $data["employee_id"];
        $_SESSION["tempYogoComName"] = $data["company_name"];
        $_SESSION["tempYogoComId"] = $data['company_id'];
        $_SESSION["tempYogoEmpName"] = $data['employee_name'];
        $_SESSION["tempYogoEmpTelNo"] = $data['phone_no'];
        $_SESSION["tempYogoEmpEmail"] = $data['email'];

        header("Location: ../view/sign-up.php");

    } else {
        session_destroy();
        header("Location: ../view/sign-in.php");
    }
}

