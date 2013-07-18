<?php
session_start();
require_once "database.php";
require_once "databaseaware.class.php";
require_once "maillist.class.php";
require_once "addEmailDelete.class.php";
//$userID=$_SESSION['userId']; UserId se pazi v sesiqta

if (isset($_POST['newEmail']))
  { 	
		if ($_POST["newEmail"]!=""){ 
				$listId=$_POST["listId"];
				$email=$_POST['newEmail'];

	 			$newEmail=new AddEmailDelete ($mysqli, $listId);
	 			$newEntry=$newEmail->addEmail($email);
	 			echo json_encode($newEntry);
		 }
    }

