<?php
  require_once "functions.php";
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title>MSG System!</title>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="clock.js"></script>

	<link rel="stylesheet" type="text/css" href="main.css">
	
</head>

<body onload="startTime()">


<div id="page">
		<h3>
			<div id="corner">
			</div>
		</h3>
		
		<div id="header">
		<h1>Message Table</h1>
				<hr />
		</div>
		<div id="rightMenu">
				<p><button class= "buttonBig"  onclick="location.href='postmessage.php'">Add New Message</button></p>
				<p><button class= "buttonBig" id="showAllMsg">View All Messages</button></p>
				<p><button class= "buttonBig" id="showTodayMsg">View Messages From Today</button></p>
				
				<?php
				if(isset($_SESSION["userId"])) 
						{				
							echo "<p><button class= 'buttonBig' id='editMsg'>Edit Messages</button></p>";
						}		
				?>
				<div id="labels">					
						<label for="date1">From Date:</label>
				</div>
						<input name="date1" id="dateFrom"/>	<br/>				
				<div id="labels">
						<label for="date2">To Date:</label>
				</div>
						<input name="date2" id="DateTo"/>					
					<p>
						<button class= "buttonSmall" id="searchMsg">Search</button>
					</p>
				

		</div>
		<div id="menu">
			
				<?php 	
					if(isset($_SESSION["userId"])) 
					{
					
				?>		
						
						<button class='buttonSmall' onclick="location.href='logout.php'">Logout</button>						
				<?php 
					echo "<br/>";
					echo "<br/>";
					ShowWhoIsOnline();
					}
				?>	
			
			
		</div>
		
		
		<div id="messages">
				<?php	
						
						if(isset($_SESSION["userId"])) 
						{				
							ShowMsg();
							if(isset($_POST['del'])) {
								foreach ( $_POST as $key => $value )
									{	
										if ($key != "del")
										{
											deleteMsg($_POST[ $key ] );
										}								
									}
							}
						}				
						else
						{
							ShowMsg();
						}
				?>		
		</div>
		
		<script type="text/javascript">
			$("#showTodayMsg").click(function(event){
						$("#messages").empty();
						$.ajax({
						url: "ShowSearchedMsg.php",
						contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15"
						}).done(function(response){
						$("#messages").html(response);
						});	
						})
			
			$("#showAllMsg").click(function(event){
						$("#messages").empty();
						$.ajax({
						url: "ShowAllMsg.php",
						contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15"
						}).done(function(response){
						$("#messages").html(response);
						});	
						})
						
			$("#editMsg").click(function(event){
						$("#messages").empty();
						$.ajax({
						url: "EditMsg.php",
						contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15"
						}).done(function(response){
						$("#messages").html(response);
						});	
						})

			$(function() {
							$( "#dateFrom" ).datepicker({ autoSize: true });
						});	
			$(function() {
							$( "#DateTo" ).datepicker({ autoSize: true });
						});
		</script>
		
	</div>
</body>
</html>
