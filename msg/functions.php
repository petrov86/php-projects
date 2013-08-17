<?php
	require_once "database.php";
	session_start();

		function ShowMsg()
		{
			$sql = "SELECT messages.msgID, messages.message, messages.message_time, users.username FROM messages 
					JOIN users ON messages.userID= users.id 
					ORDER BY messages.msgID DESC";
			$res = mysql_query($sql);
			$stringResult="";
			while ($row = mysql_fetch_assoc($res)) {			
					$stringResult = $stringResult."<pre><div><p>From: <b>" . $row["username"] . ", </b>Posted at: " . $row["message_time"]. 
					"</p><h4>".$row["message"]."</h4></div><hr/></pre>";
			}
			echo $stringResult;
		}
		
		
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
		/*
		function DelMsgForm()
		{	
			
			$sql = "SELECT messages.msgID, messages.message, messages.message_time, users.username FROM messages 
					JOIN users ON messages.userID= users.id 
					ORDER BY messages.msgID DESC";
			$res = mysql_query($sql);
			echo "<form method='post' action=''>";
			while ($row = mysql_fetch_assoc($res)) {			
				echo "<div>";
				echo "<input type='checkbox' value=". $row["msgID"]. " name=".$row["msgID"]."> From: <b>" . $row["username"] . ",</b>  "  
				."Posted at: " . $row["message_time"];	
				echo "<h4>".$row["message"]."</h4>";				
				echo "</div>";
				echo "<hr />";
			}
			echo "<input type='submit' value='Delete Message' name='del' class='buttonBig'>";
			echo "</form>";
			
		}
		*/
		
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
?>
