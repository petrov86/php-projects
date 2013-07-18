<?php
session_start();
require_once "database.php";
require_once "databaseaware.class.php";
require_once "maillist.class.php";
require_once "login.class.php";

$userID=$_SESSION['userId'];

if (isset($_POST['NewListName']))
  { 	 	
		if ($_POST["NewListName"]!=""){ 
			$listName=$_POST['NewListName'];
			$list = new MailList($mysqli, $listName, $userID);
				$entry = $list -> save();

				echo json_encode($entry);
			}
	}		
			
