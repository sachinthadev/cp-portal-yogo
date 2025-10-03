<?php
include_once('../util/services.php');
include_once('../util/session.php');

/**
 *
 */


$postData = json_decode(file_get_contents('php://input'), true);
$tripType = $postData['type'];
$requestData = array(
    "guid" => $_SESSION["YogoCorpGuid"],
    "company_id" => $_SESSION["YogoCorpCompanyId"],
    "list_type" => $tripType,
    "end_date" => $postData['endDate'],
    "start_date" => $postData['startDate'],
);

$pageCount = 3;
$data = array();

for ($i = 1; $i < $pageCount; $i++) {
    $pageData = json_decode(post($requestData, "corporateportal/TripListDo/$i"), true);
    //echo json_encode($pageData);
    $pageCount = $pageData['page_count'] + 1;
    array_push($data, $pageData['data']);
}
//echo json_encode($data);
if (array_key_exists('status', $data)) {

    if ($data['Error'] == "guid failed") {
        echo json_encode(array('status' => 1));
    } else {
        echo json_encode(array('status' => 2, 'message' => $data['Error']));
    }
} else {

    $output = array();
    foreach ($data as $a) {
        foreach ($a as $eData) {
            if (array_key_exists('apimessage', $eData)) {
                break;
            } else {
                if ($tripType == 5) {
                    $rowData = array($eData['booking_id'], $eData['booking_start_point'], $eData['booking_end_point'], $eData['employee_name'], $eData['requested_by'], $eData['remark']);
                    array_push($output, $rowData);
                } else {
                    $rowData = array($eData['booking_id'], $eData['booking_start_point'], $eData['booking_end_point'], $eData['start_time'], $eData['trip_distance'], $eData['total_amount'], $eData['employee_name'], $eData['status'], $eData['remark'] ,$eData['is_verify']);
                    array_push($output, $rowData);
                }
            }
        }
    }
    echo json_encode(array('status' => 0, 'data' => $output));
}
