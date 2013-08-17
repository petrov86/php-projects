<?php 
session_start();
require_once "database.php";

$userID = $_SESSION["userId"];

	$sql = "UPDATE online_users SET b_IsLastMessageShown='1' WHERE userID = '$userID' LIMIT 1";
	$result = mysql_query($sql) or die(mysql_error());
	
