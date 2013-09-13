<?php
require_once "database.php";
require_once "functions.php";

$DateTimeNow =  date( 'Y-m-d H:i:s');


function ShowSearchedMsg ($DateFrom, $DateTo, $messageStr)
		{	
			
			$sql = "SELECT messages.msgID, messages.message, messages.message_time, users.username FROM messages 
					JOIN users ON messages.userID= users.id 
					WHERE messages.message_time >= '$DateFrom' AND messages.message_time <= '$DateTo' AND messages.message LIKE '%$messageStr%' 
					ORDER BY messages.msgID DESC";
			$res = mysql_query($sql);
			$stringResult ="";
			while ($row = mysql_fetch_assoc($res)) {	
					if(filter_var($row["message"], FILTER_VALIDATE_URL))
					{	
						$row["message"] = makeClickableLinks($row["message"]);
					}
					$stringResult = $stringResult."<div><p>From: <b>".$row["username"].", </b>Posted at: ". $row["message_time"]."</p><h4>".$row["message"]."</h4></div><hr/>";	
			}
			//$stringResult=iconv("UTF-8",$stringResult);
			$stringResult = html_entity_decode($stringResult); 
			echo $stringResult;				
			//echo json_encode($stringResult);
		}		
		

$DateFrom = '1970-01-01';
$DateTo = date( 'Y-m-d H:i:s');
$messageStr="";		
		
if (isset($_POST["messageStr"]))
	{ 	 	
		$messageStr = $_POST["messageStr"]; 		
	}		
if (isset($_POST["DateFrom"]))
	{ 	 	
		$DateFrom = $_POST["DateFrom"]; 		
	}		

if (isset($_POST["DateTo"]))
	{ 	 
  		if($_POST["DateTo"] != date('Y-m-d'))
  		{
  			$DateTo = $_POST["DateTo"]. '24:0:0'; 	
  		}	
  		
	}		
  
ShowSearchedMsg ($DateFrom, $DateTo, $messageStr);
