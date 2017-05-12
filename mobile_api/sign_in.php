<?php
/*
* created by Presisco on 2017/5/12
*/

// get input data
$username=$_POST['username'];
$password=$_POST['password'];
 
// include db conn class
require_once __DIR__ . '/db_conn.php';

// connecting to db
$database=new db_conn();
if($database->connect_errno){
	echo "connect failed";
}

// query the password
$sql="select password from user_info where username=".$username;

$result=$database->query($sql);

// compare result
if($result['password']==$password){
	return "succeed";
}else{
	return "failed";
}

?>