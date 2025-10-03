<?php
session_start();
include_once('../util/services.php');


/**
 *
 */


$postData = json_decode(file_get_contents('php://input'), true);

$requestData = array(
    "guid" => $_SESSION["YogoCorpGuid"],
    "booking_id" => $postData['bookingid']
);
//echo json_encode($requestData);
$data = json_decode(post($requestData, "corporateportal/getRouteDo"), true);
//echo json_encode($data);
if (array_key_exists('status', $data)) {

    if ($data['Error'] == "guid failed") {
        echo json_encode(array('status' => 1));
    } else {
        echo json_encode(array('status' => 2, 'message' => $data['Error']));
    }

} else {
    if ($data['respond'] == "Invalid Ref No") {
        echo json_encode(array('status' => 3));
        return;
    }
    echo json_encode(array('status' => 0, 'data' => $data));
}






