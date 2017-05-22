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
	$sql=$sql." and date > ".$start_time;
}

if($end_time != null){
	$sql=$sql." and date < ".$end_time;
}

$result=array();
// bind data to statement
$result["default"]=$database->query(str_replace("?","default",$sql));
$result["aerobic"]=$database->query(str_replace("?","aerobic",$sql));
$result["anaerobic"]=$database->query(str_replace("?","anaerobic",$sql));
$result["sleep"]=$database->query(str_replace("?","sleep",$sql));

echo json_encode(result)

?>