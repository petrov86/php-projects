<?php
session_start();
require_once "database.php";
require_once "databaseaware.class.php";
require_once "maillist.class.php";
require_once "addEmailDelete.class.php";
$userID=$_SESSION['userId'];

$myFile = 'test.txt'; 
$myContent =var_export($_POST, TRUE); 
file_put_contents($myFile, $myContent); 

if (isset($_POST["listId"]))
  {	
		$listId=$_POST["listId"];
		$newObject= new maillist ($mysqli, "", $userID);
		$deleteList = $newObject->delete($listId);
	}
