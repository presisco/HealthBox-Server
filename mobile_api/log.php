<?php
function log_to_file($content){
	error_log($content."\n",3,"/var/log/apache2/php-output.log");
}
?>