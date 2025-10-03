<?php
session_start();
include_once('../util/services.php');


/**
 *
 */


$postData = json_decode(file_get_contents('php://input'), true);

$requestData = array(
    "company_id" => $_SESSION['YogoCorpCompanyId'],
    "employee_id" => $postData['employeeid']
);
//echo json_encode($requestData);
$data = json_decode(post($requestData, "companyemployee/getEmployeeDetails"), true);
//echo json_encode($data);
if (array_key_exists('status', $data)) {

    if ($data['Error'] == "guid failed") {
        echo json_encode(array('status' => 1));
    } else {
        echo json_encode(array('status' => 2, 'message' => $data['Error']));
    }

} else {
    echo json_encode(array('status' => 0, 'data' => $data));
}






