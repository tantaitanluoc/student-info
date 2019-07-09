<?php
if(isset($_GET['signmeout'])){
	session_start();
	session_unset();
	session_destroy();
}
?>