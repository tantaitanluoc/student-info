<?php

  // Code by Vo Tan Tai
  // Contact me: tantaivo2015@gmail.com 

if(isset($_GET['signmeout'])){
	session_start();
	session_unset();
	session_destroy();
}
?>