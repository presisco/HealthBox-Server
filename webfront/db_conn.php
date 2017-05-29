<?php
class db_conn extends mysqli{
	function __construct(){
		require_once __DIR__ . '/db_config.php';
		parent::__construct(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	}
}
?>