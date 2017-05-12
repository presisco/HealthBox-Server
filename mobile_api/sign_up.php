<?php
/*
* created by Presisco on 2017/5/11
*/
 
// include db conn class
//require_once __DIR__ . '/db_config.php';
require_once __DIR__ . '/db_conn.php';

// connecting to db
//$database = new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
$database=new db_conn();
if($database->connect_errno){
	echo "connect failed";
}

$sql="insert into user_info(username,password,age,gender,political_status,education_status,career_status,annual_income,social_status,usage_frequency,trust,channel) values (?,?,?,?,?,?,?,?,?,?,?,?)";

// get a statement for insert operation
$stmt=$database->prepare($sql);

// bind data to statement
$stmt->bind_param("s",$_POST['username']);
$stmt->bind_param("s",$_POST['password']);
$stmt->bind_param("i",$_POST['age']);
$stmt->bind_param("i",$_POST['gender']);
$stmt->bind_param("i",$_POST['political_status']);
$stmt->bind_param("i",$_POST['education_status']);
$stmt->bind_param("i",$_POST['career_status']);
$stmt->bind_param("i",$_POST['annual_income']);
$stmt->bind_param("i",$_POST['social_status']);
$stmt->bind_param("i",$_POST['usage_frequency']);
$stmt->bind_param("i",$_POST['trust']);
$stmt->bind_param("i",$_POST['channel']);

// execute statement and return
if(!$stmt->execute()){
	echo "failed";
}else{
	echo "succeed";
}

$stmt->close();
?>