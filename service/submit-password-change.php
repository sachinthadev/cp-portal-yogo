<?php
session_start();
include_once('../util/services.php');


/**
 *
 */


$postData = json_decode(file_get_contents('php://input'), true);

$requestData = array(
    "guid" => $_SESSION["YogoCorpGuid"],
    "new_password" => $postData['newpassword'],
    "confirm_password" => $postData['confirmpassword'],
    "old_password" => $postData['currentpassword'],
);
//echo json_encode($requestData);
$data = json_decode(post($requestData, "corpuser/changePasswordDo"), true);

if ($data['status'] == 1) {

    if ($data['Error'] == "wrong GUID or GUID missing") {
        echo json_encode(array('status' => 1));
    }else{
        echo json_encode(array('status' => 2, 'message' => $data['Error']));
    }

}else{
    echo json_encode(array('status' => 0, 'data' => $data));
}






