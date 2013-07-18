<?php
session_start();
define ('msg', 'You send your message succesfully!');
/*$_POST["subscribers"]="keeepwalking@mail.bg;";
$_POST['message']="hello";
$_POST['subject']="no subject";*/

if (isset($_SESSION["loggedIn"]) ){

  	$subscribers = $_POST["subscribers"];
		$message = $_POST['message'];
		$subject = $_POST['subject'];
		$arrSubscribers = explode("; ", $subscribers);
		$recipient_list = implode(",",$arrSubscribers);

		$myFile = 'test.txt'; 
		$myContent =var_export($arrSubscribers, TRUE); 
		file_put_contents($myFile, $myContent); 

		$headers = 'From: webmaster@example.com' . "\r\n" .
    	'Reply-To: webmaster@example.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
   		echo msg;
   		/*if(mail($recipient_list, $subject, $message, $headers))
	{
		echo "congratulations";
	}

else
	{
		echo "wrong";
	}*/

}

	
