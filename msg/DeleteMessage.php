<?php
require_once "functions.php";


	if(isset($_SESSION["userId"])) 
	{		
		if(isset($_POST['msgIDarray'])) 
		{
			foreach ( $_POST['msgIDarray'] as $key => $value )
				{	
					
					deleteMsg($_POST['msgIDarray'][ $key ]);										
				}	
		}
	}			
?>		