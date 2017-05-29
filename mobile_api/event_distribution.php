<?php
/*
* created by Presisco on 2017/5/22
*/
 
// include db conn class
// require_once __DIR__ . '/db_config.php';
require_once __DIR__ . '/db_conn.php';
require_once __DIR__ . '/log.php';

// get query info
$start_time=$_POST['start_time'];
$end_time=$_POST['end_time'];

// connecting to db
// $database = new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$database=new db_conn();
if($database->connect_errno){
	echo "connect failed";
}

$sql="select count(*) as total from user_health_event where event_type = '?'";

if($start_time != null){
	$sql=$sql." and date > '".$start_time."'";
}

if($end_time != null){
	$sql=$sql." and date < '".$end_time."'";
}

$result=array("default"=>"","aerobic"=>"","anaerobic"=>"","sleep"=>"");

// bind data to statement

foreach($result as $type=>$count){
	$final_sql=str_replace("?",$type,$sql);
	$query=$database->query($final_sql);
	if($query){
		$row=$query->fetch_assoc();
		$result[$type]=$row['total'];
	}
}

echo json_encode($result)

?>