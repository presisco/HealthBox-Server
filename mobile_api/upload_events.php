<?php
/*
* created by Presisco on 2017/5/11
*/
 
// include db conn class
require_once __DIR__ . '/db_conn.php';

// connecting to db
$connection = new db_conn();

// get a statement for insert operation
$stmt = $connect->prepare("insert into user_health_event(username,event_type,body_sign,averate_stats,date,duration,evaluation) values (?,?,?,?,?,?,?,?)");

// bind data to statement
$stmt->bind_param("s",$_POST['username']);
$stmt->bind_param("s",$_POST['event_type']);
$stmt->bind_param("s",$_POST['body_sign']);
$stmt->bind_param("i",$_POST['averate_stats']);
$stmt->bind_param("s",$_POST['date']);
$stmt->bind_param("i",$_POST['duration']);
$stmt->bind_param("s",$_POST['evaluation']);

// execute statement and return
if(!stmt->execute()){
	echo "failed"
}else{
	echo "succeed"
}
?>