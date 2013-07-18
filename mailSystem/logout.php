<?php
  session_start();
	
	unset($_SESSION["loggedIn"]);
	unset($_SESSION["username"]);
	unset($_SESSION['userID']);
	session_destroy();
	
	header ("location: login.html");
	exit;
?>
