<?php
session_start();
require_once "database.php";
require_once "login.class.php";
require_once "DatabaseAware.class.php";

//if (isset($_SESSION["loggedIn"] )){header ("Location: index.html");}

if(isset($_POST["username"], $_POST["password"])) {
  	$user=$_POST["username"];
		$pass=$_POST["password"];
		$p=new Login($user, $pass, $mysqli);
		$newEntry=$p->Login();
		echo $newEntry;
	/*
		$myFile = 'test.txt'; 
		$myContent =var_export($_SESSION, TRUE); 
		file_put_contents($myFile, $myContent); */
}

?>
