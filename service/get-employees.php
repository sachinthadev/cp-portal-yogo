<?php
session_start();
include_once('../util/services.php');

$output = array();

$data1 = array("0001", "Saman Kumara");
array_push($output,$data1);
$data2 = array("0002", "Peter Perera");
array_push($output,$data2);
$data3 = array("003", "Test 3");
array_push($output,$data3);
$data4 = array("004", "Test 4");
array_push($output,$data4);

echo json_encode(array('status' => 0, 'data' => $output));