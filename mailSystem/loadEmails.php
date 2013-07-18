<?php 
session_start();
require_once "database.php";
require_once "databaseaware.class.php";
require_once "maillist.class.php";

$userID=$_SESSION['userId'];
$listID=$_POST['listId']; 
  			
$loadEmails = new MailList($mysqli, "", $userID);
$entry = $loadEmails -> getEmails($listID);
