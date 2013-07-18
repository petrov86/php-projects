<?php 

session_start();
require_once "database.php";
require_once "login.class.php";
require_once "DatabaseAware.class.php";

//if (isset($_SESSION["loggedIn"] )){header ("Location: index.html");}

  	$myFile = 'test.txt'; 
		$myContent =var_export($_SESSION, TRUE); 
		file_put_contents($myFile, $myContent); 

if (isset($_POST["submit"])) {
		$currentDate=date("Y-m-d H:i:s"); 
		$username=$_POST["username"];
		$firstname=$_POST["firstname"];
		$lastname=$_POST["lastname"];
		$password=$_POST["pass"];
		$pass2=$_POST["pass2"];
		$password_MD5=MD5($password);
		$postKeys=array("username", "pass", "pass2");
				if( !isset( $_POST["username"]) AND !isset($_POST["pass"]) AND !isset($_POST["pass2"]) AND !isset($_POST["firstname"])  AND !isset($_POST["lastname"])) 
					{
						//navigate("register.html");
						header ("Location: register.html");
					}
				elseif($password!==$pass2)
					{
						//header ("Location: register.html");
						echo "Wrong password";
					}
				else 
					{
						$newObject=new Login($username, $password, $mysqli);
						$newEntre= $newObject->Register($firstname, $lastname, $currentDate);
					}


}



?>
