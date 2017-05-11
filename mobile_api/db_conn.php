<?php
class db_conn extends mysqli{
	function __construct(){
		parent::__construct("localhost","root","pwd4mysql","android_connection_test");
	}
}
?>