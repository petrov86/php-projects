<?php
	session_start();
	require_once "database.php";
	
	
	if(isset($_SESSION["userId"])) {
		header("Location: postmessage.php");
		exit;
	}

	$userMessage = "";

	// will handle the POST request
	if(isset($_POST["username"], $_POST["password"])) {
		$username = mysql_real_escape_string($_POST["username"]);
		$password = md5(mysql_real_escape_string($_POST["password"]));
		
		$sql = "SELECT id FROM users 
				WHERE username = '$username' AND password = '$password' 
				LIMIT 1";

		$res = mysql_query($sql);
		$row = mysql_fetch_assoc($res);
		
		if(!$row) {
			$userMessage = "Wrong username OR password";
			echo "<script type=\"text/javascript\">"; 
			echo "alert('$userMessage')"; 
			echo "</script>";
		} else {
			$_SESSION["userId"] = $row["id"];
			$userID = $_SESSION["userId"];
			$loginTime = date( 'Y-m-d H:i:s');
			$_SESSION["loginTime"] = $loginTime;
			$sqlUpdateOnlineUser = "UPDATE online_users SET b_IsLastMessageShown='1', isOnline='1', lastLogin='$loginTime' WHERE userID=$userID";
			$res3 = mysql_query($sqlUpdateOnlineUser) or die(mysql_error());
			
			header("Location: postmessage.php");

		}
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title>Login to MSG!</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>
<body>
<button  class="buttonSmall" onclick="location.href='index.php'">Back</button>

	<div id="container">
		<h1>Welcome to Login page!</h1>
		<form method="post" action="">
			<input name="username" type="text" placeholder="Username" required />
			<br />
			<br />
			<input name="password" type="password" placeholder="Password" required />
			<br />
			<br/>
			<input type="submit" value="Login"  class="buttonSmall"/> 
			<button class='buttonSmall' onclick="location.href='register.php'">Register</button>
		</form>
	
	<script "javacript"> 
		$(':button').css( 'cursor', 'pointer' );
		$('.buttonSmall').css( 'cursor', 'pointer' );
	</script>
	</div>
</body>
</html>