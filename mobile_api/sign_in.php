<?php
/*
* created by Presisco on 2017/5/12
*/

require_once __DIR__ . '/log.php';

// get input data
$username=$_POST['username'];
$password=$_POST['password'];

log_to_file("has login");
log_to_file("password: $password, username: $username");
 
// include db conn class
require_once __DIR__ . '/db_conn.php';

// connecting to db
$database=new db_conn();
if($database->connect_errno){
	echo "connect failed";
}

// query the password
$sql="select password from user_info where username='$username'";

$result=$database->query($sql);
$row=$result->fetch_assoc();
log_to_file("password for $username: ".$row['password']);
// compare result
if($row['password']==$password){
	echo "succeed";
}else{
	echo "failed";
}

?>