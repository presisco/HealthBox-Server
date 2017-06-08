<?php
function log_to_file($content){
	error_log($content."\n",3,"php-output.log");
}
?>