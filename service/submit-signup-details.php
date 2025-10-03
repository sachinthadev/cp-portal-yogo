<?php
session_start();
include_once('../util/services.php');


/**
 *
 */


$postData = json_decode(file_get_contents('php://input'), true);
$requestData = array("company_id" => $_SESSION["tempYogoComId"], "employee_id" => $_SESSION["tempYogoEmpId"], "email" => $_SESSION["tempYogoEmpEmail"], "password" => $postData['password']);

$data = json_decode(post($requestData, "corpuser/signUpDo"), true);
//echo json_encode($data);
if (array_key_exists('Error', $data)) {
    session_destroy();
    echo json_encode(array('status' => 1, 'message' => $data['Error']));
} else {

    if ($data['status'] == 1) {

        echo json_encode(array('status' => 1, 'message' => $data['Error']));

    } else {
        session_destroy();
        echo json_encode(array('status' => 0));
    }
}
