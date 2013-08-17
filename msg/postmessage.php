<?php
	session_start();
	require_once "database.php";
	
	if(!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit;
	}
	
	$userId = $_SESSION["userId"];	
	$usernameSql = "SELECT username FROM users WHERE id = $userId LIMIT 1";
	$usernameRes = mysql_query($usernameSql);
	$usernameRow = mysql_fetch_assoc($usernameRes);
	
	if(isset($_POST["message"])) {
		$message = mysql_real_escape_string($_POST["message"]);
		//$message = iconv("UTF-8",$message);
		$message = htmlspecialchars($message);
		$message = htmlentities($message); 

		$messageTime = date( 'Y-m-d H:i:s');
		if ($message != "")
		{
				$sql = "INSERT INTO messages(msgID, message, message_time, userID) 
				VALUES( '', '$message', '$messageTime', '$userId')";
				$res = mysql_query($sql);
				if(!$res)
				{
					echo "Message not added!";
				}
				if($res) 
				{
					//redirect to index.php
					//echo $usernameRes. "added a message";
					$sqlUpdate_bIsLastMessageShown = "UPDATE online_users SET b_IsLastMessageShown='0' WHERE userID != '$userId' ";
					$result = mysql_query($sqlUpdate_bIsLastMessageShown) or die(mysql_error());	
	
				    //echo "New message from <b>".$usernameRow["username"]."</b>";
					header("Location: index.php");
					//echo $userId;
				}
		}
	
	}
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title>Post a messsage!</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<style type="text/css">
		textarea {
			width: 600px;
			height: 350px;
		}
	</style>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>
<body>
	<button class='buttonSmall' onclick="location.href='logout.php'">Logout</button>
	</br>
	</br>
	<button class='buttonSmall' onclick="location.href='index.php'">Back</button>
	
	
	<div id="container">
		<h1>Hello, <?php echo $usernameRow["username"] ?> !</h1>
		<form method="post" action="">
			<textarea placeholder="Enter your message" name="message"></textarea>
			<br />
			<input type="submit" value="Send your message!" class="buttonBig"/>
		</form>
		
			
	<script > 
		$(':button').css( 'cursor', 'pointer' );
		$('.buttonBig').css( 'cursor', 'pointer' );
	</script>		
	</div>
</body>
</html>
