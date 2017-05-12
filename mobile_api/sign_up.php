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
$stmt->bind_param("ssiiiiiiiiii"
	,$_POST['username']
	,$_POST['password']
	,$_POST['age']
	,$_POST['gender']
	,$_POST['political_status']
	,$_POST['education_status']
	,$_POST['career_status']
	,$_POST['annual_income']
	,$_POST['social_status']
	,$_POST['usage_frequency']
	,$_POST['trust']
	,$_POST['channel']);

// execute statement and return
if(!$stmt->execute()){
	echo "failed";
}else{
	echo "succeed";
}

$stmt->close();
?>