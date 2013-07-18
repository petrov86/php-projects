<?php 
session_start();
require_once "database.php";
require_once "databaseaware.class.php";
require_once "maillist.class.php";
$userID=$_SESSION["userId"];
if(!isset($_SESSION["userId"])) {
  	header("Location: login.php");
		exit;
	}
	
$list = new MailList($mysqli, "", $userID);
$entry = $list -> get();

echo json_encode($entry);
