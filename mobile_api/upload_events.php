<?php
/*
* created by Presisco on 2017/5/11
*/

require_once __DIR__ . '/log.php';

// parse jsonarray data

$json_array = file_get_contents("php://input");
$event_array = json_decode($json_array);
log_to_file("received events length: ".count($event_array));

// include db conn class
require_once __DIR__ . '/db_conn.php';

// connecting to db
$connection = new db_conn();

// define insert prototype
$sql="insert into user_health_event(username,event_type,body_sign,averate_stats,date,duration,evaluation) values ";

// add data to prototype
foreach ($event_array as $event){
	log_to_file("event var type: ".gettype($event));
	/*
	$sql=$sql 
		. "(" . $event->username
		. "," . $event->event_type
		. "," . $event->body_sign
		. "," . $event->averate_stats
		. "," . $event->date
		. "," . $event->duration
		. $event->evaluation . "),";
	*/
}

// cut the charactor at tail
$sql=substr($sql,0,-1);

// execute insert and return
if(!$connection->query($sql)){
	echo "failed";
}else{
	echo "succeed";
}

?>