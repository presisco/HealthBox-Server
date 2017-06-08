<?php
/*
* created by Presisco on 2017/5/12
*/

require_once __DIR__ . '/log.php';

// get input data
$body_sign=$_POST['body_sign'];
$username=$_POST['username'];
$classification=$_POST['classification'];
$event_type=$_POST['event_type'];

log_to_file("getting advice");
log_to_file("username: $username, body_sign: $body_sign, classification: $classification, event_type: $event_type");
 
// include db conn class
require_once __DIR__ . '/db_conn.php';

// connecting to db
$database=new db_conn();
if($database->connect_errno){
	echo "connect failed";
}

// query user age and gender
$sql="select age,gender from user_info where username='$username'";

$result=$database->query($sql);
$row=$result->fetch_assoc();

log_to_file("user age:".$row['age'].", gender:".$row['gender']);

// convert to age interval
$age_intervals=array(16,25,35,50,70);
$array_size=count($age_intervals);
$age_interval=1;
for($i=0;$i<$array_size;$i++){
	if($row['age']>$age_intervals[$i]){
		$age_interval++;
	}
}

$sql="select advice from advice where body_sign='$body_sign' and age_interval=$age_interval and gender=".$row['gender']." and event_type='$event_type' and classification='$classification'";

log_to_file($sql);

$result=$database->query($sql);
$row=$result->fetch_assoc();
echo $row['advice'];

?>