<?php
	session_start();
	require_once "database.php";
	
	$userID = $_SESSION["userId"];
	$sqlUpdateOnlineUser = "UPDATE online_users SET isOnline='0' WHERE userID=$userID";
	$res3 = mysql_query($sqlUpdateOnlineUser) or die(mysql_error());
	unset($_SESSION["userId"]);
	session_destroy();
	header("Location: index.php");
