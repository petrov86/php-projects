<?php 
session_start();
require_once "database.php";

$userID = $_SESSION["userId"];
$isLastMessageShown = -1;

	$sql = "SELECT b_IsLastMessageShown FROM online_users 
			WHERE userID = '$userID' LIMIT 1";

	$res = mysql_query($sql);
	$row = mysql_fetch_assoc($res);
	if ($row["b_IsLastMessageShown"] == 0)
	{
		$isLastMessageShown = 0;
	}
	else
	{
		$isLastMessageShown = 1;
	}

	echo $isLastMessageShown;	
//sqlUpdate_bIsLastMessageShown