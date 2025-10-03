<?php
session_start();
include_once('../util/services.php');


/**
 *
 */


$postData = json_decode(file_get_contents('php://input'), true);
//echo json_encode($postData);
$requestData = array(
    "booking_id" => $postData["bookingId"],
    "company_id" => $_SESSION["YogoCorpCompanyId"],
    "branch_id" => $postData["branchSelect"],
    "department_id" => $postData["departmentSelect"],
    "employee_id" => $postData["memberSelect"]
);
//echo json_encode($requestData);
$data = json_decode(direct_post($requestData, "http://dealer.linklanka.lk/Booking/BranchAdd"), true);
//echo json_encode($data);
if ($data['status'] != 1) {

    if ($data['Error'] == "wrong GUID or GUID missing") {
        echo json_encode(array('status' => 1));
    }else{
        echo json_encode(array('status' => 2, 'message' => $data['Error']));
    }

}else{
    echo json_encode(array('status' => 0, 'data' => $data));
}






