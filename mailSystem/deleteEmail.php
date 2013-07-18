<?php
session_start();
require_once "database.php";
require_once "databaseaware.class.php";
require_once "maillist.class.php";
require_once "addEmailDelete.class.php";

if (isset($_POST['arraySelectedEmail']))
  { 	
		$record=$_POST["arraySelectedEmail"];
		$deleteEmail=new AddEmailDelete ($mysqli, "");
	 	$deleteEntry=$deleteEmail->deleteEmail($record);
	 	//echo json_encode($newEntry);

	}
