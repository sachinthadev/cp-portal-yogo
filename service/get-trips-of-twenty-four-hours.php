<?php
include_once('../util/services.php');
include_once ('../util/session.php');

/**
 *
 */


$postData = json_decode(file_get_contents('php://input'), true);

$requestData = array(
    "guid" => $_SESSION["YogoCorpGuid"],
    "company_id" => $_SESSION["YogoCorpCompanyId"],
    "list_type" => $postData['type'],
);
//echo json_encode($requestData);
$data = json_decode(post($requestData, "corporateportal/TripListTodayDo"), true);
//echo json_encode($data);
if (array_key_exists('status', $data)) {

    if ($data['Error'] == "guid failed") {
        echo json_encode(array('status' => 1));
    }else{
        echo json_encode(array('status' => 2, 'message' => $data['Error']));
    }

}else{

    $output = array();
    foreach ($data as $eData){
        if (array_key_exists('apimessage', $eData)){
            break;
        }else {
            $rowData = array($eData['booking_id'], $eData['booking_start_point'],$eData['booking_end_point'],$eData['start_time'],$eData['trip_distance'],$eData['employee_name'],$eData['status'],$eData['remark']);
            array_push($output,$rowData);
        }
    }
    echo json_encode(array('status' => 0, 'data' => $output));
}







