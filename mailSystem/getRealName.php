<?php
session_start();

if (isset ($_SESSION["username"]) && ($_SESSION["loggedIn"]) == true ) {
  	$realname = $_SESSION["realname"];
		echo $realname;
	}
else 
	{
		echo "login.html";
	}
?>
