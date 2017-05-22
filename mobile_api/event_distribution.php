<?php
/*
* created by Presisco on 2017/5/22
*/
 
// include db conn class
// require_once __DIR__ . '/db_config.php';
require_once __DIR__ . '/db_conn.php';

// get query info
$start_time=$_POST['start_time'];
$end_time=$_POST['end_time'];

// connecting to db
// $database = new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$database=new db_conn();
if($database->connect_errno){
	echo "connect failed";
}

$sql="select count(*) from user_health_event where event_type = ?";

if($start_time != null){
	$sql=$sql." and start_time > ".$start_time
}

if($end_time != null){
	$sql=$sql." and start_time < ".$end_time
}

// get a statement for insert operation
$stmt=$database->prepare($sql);

$result=array();
// bind data to statement
$stmt->bind_param("s","default");
$stmt->execute();
$result["default"]=$stmt->get_result();
$stmt->bind_param("s","aerobic");
$stmt->execute();
$result["aerobic"]=$stmt->get_result();
$stmt->bind_param("s","anaerobic");
$stmt->execute();
$result["anaerobic"]=$stmt->get_result();
$stmt->bind_param("s","sleep");
$stmt->execute();
$result["sleep"]=$stmt->get_result();

$stmt->close();

echo json_encode($response)

?>