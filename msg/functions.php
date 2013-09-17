<?php
	require_once "database.php";
	session_start();
		
		function ShowWhoIsOnline()
		{	
			$sql = "SELECT users.username as users_username FROM online_users, users WHERE (online_users.isOnline='1') AND (online_users.userID= users.id) ORDER BY users.id DESC";	
			$res = mysql_query($sql) or die(mysql_error());
			echo "<b>Online are: </b>";
			echo "<br/>";
			while ($row = mysql_fetch_assoc($res)) 
			{			
				echo $row["users_username"];
				echo "<br/>";
			}
			echo "<br/>";
		}

		
		function DeleteMsg($msgID)
		{
			$sql = "DELETE messages FROM messages WHERE msgID=$msgID";
			$res = mysql_query($sql);
			if(!$res)
			{
				echo "Message not deleted!";
			}
		
		}
		
		
		function direction($direction="index.php")
		{		
			header("Location: $direction");
		}	
		
		
		function makeClickableLinks($str) {
			return preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.-]*(\?\S+)?)?)?)@', '<a href="$1">$1</a>', $str);
		}
		
?>