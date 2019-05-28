<?php
// ini_set('session.cookie_domain',substr($_SERVER['SERVER_NAME'],strpos($_SERVER['SERVER_NAME'],"."),100));
if(isset($_GET['signmeout'])){
	session_start();
	session_unset();
	session_destroy();
}

?>