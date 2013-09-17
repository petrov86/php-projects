<?php
	session_start();
	require_once "database.php";
	
	if(!isset($_SESSION["userId"])) {
		header("Location: login.php");
		exit;
	}
		
	$msgID = $_GET["msgID"]; 
	$userId = $_SESSION["userId"];	
	$sql = "SELECT message FROM messages WHERE msgID = $msgID LIMIT 1";
	$res = mysql_query($sql);
	$row = mysql_fetch_assoc($res);
	
	
	if(isset($_POST["message"])) {
		$message = mysql_real_escape_string($_POST["message"]);
		//$message = iconv("UTF-8",$message);
		$message = htmlspecialchars($message);
		$message = htmlentities($message); 

		if ($message != "")
		{
				$sqlUpdate = "UPDATE messages SET message = '$message'  WHERE msgID = $msgID ";
				$resUpdate = mysql_query($sqlUpdate);
				if(!$resUpdate)
				{
					echo "Message not updated!";
				}
				if($resUpdate) 
				{
					header("Location: index.php");
				}
		}
	
	}
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title>Update messsage!</title>
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
		<form method="post" action="">
			<textarea  name="message"><?php echo  $row['message']; ?> 
			</textarea><br/>
			<input type="submit" value="Update Message!" class="buttonBig"/>
		</form>
		
			
	<script > 
		$(':button').css( 'cursor', 'pointer' );
		$('.buttonBig').css( 'cursor', 'pointer' );
	</script>		
	</div>
</body>
</html>
