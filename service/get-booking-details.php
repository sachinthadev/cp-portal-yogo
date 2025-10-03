<?php
include_once('../util/services.php');
include_once('../util/session.php');
/**
 *
 */

$postData = json_decode(file_get_contents('php://input'), true);

$data = json_decode(get("tripV2/getDoByCorprateBookingID/" . $postData['bookingid']), true);

//json_encode($data);
if( $data != null) {
    if (array_key_exists('status', $data)) {
        echo json_encode(array('status' => 2, 'message' => "Booking details are not found"));
    } else {
        echo json_encode(array('status' => 0, 'data' => $data));
    }
}else{
    echo json_encode(array('status' => 2, 'message' => "Error in fetching booking details, Please contact YOGO support"));
}