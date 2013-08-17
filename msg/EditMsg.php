<?php
require_once "database.php";

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
		
	DelMsgForm();
