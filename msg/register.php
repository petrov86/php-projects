<?php  
	require_once "database.php";

	if(isset($_POST["username"], $_POST["password"], $_POST["rePassword"])) 
	{
		$username = mysql_real_escape_string($_POST["username"]);
		$password = md5(mysql_real_escape_string($_POST["password"]));
		$rePassword = md5(mysql_real_escape_string($_POST["rePassword"]));

		if ($password == $rePassword)
		{
			$sql = "INSERT INTO users(username, password) 
					VALUES('$username', '$password')";
			$res = mysql_query($sql);
			if($res) 
			{
					$sqlUserID = "SELECT id FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
					$resUserID= mysql_query($sqlUserID);
					$rowUserID = mysql_fetch_assoc($resUserID);
					$userID = $rowUserID['id'];
					$registerTime=date( 'Y-m-d H:i:s');
					$sql3 = "INSERT INTO online_users(userID, isOnline, lastLogin) VALUES('$userID', '0', '$registerTime')";
					$res3 = mysql_query($sql3);
					//header("Location: login.php");
					echo '<script type="text/javascript"> 
					alert("You Successfully Registered !") 
					location.href="login.php" 
					</script>';			
			}			
		}
		else
		{
			echo "<script type=\"text/javascript\">"; 
			echo "alert('Wrong Password !')"; 
			echo "</script>";	
		}
		
	}

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title>Register to MyMSG!</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>


<button  class="buttonSmall" onclick="location.href='index.php'">Back</button>

	<div id="container">
		<h1>Welcome to Register page!</h1>
		<form method="post" action="">
			<input type="text" placeholder="Username !" name="username" required />
			<br />
			<br />
			<input type="password" placeholder="Password !" name="password" required />
			<br />
			<br />
			<input type="password" placeholder="Repeat Password !" name="rePassword" required />
			<br />
			<br />
			<input type="submit" value="Register!" class="buttonSmall"/>
		</form>
	</div>
</body>
</html>
