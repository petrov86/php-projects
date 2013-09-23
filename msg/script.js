			
			var DateFrom;
			var DateTo;
			var messageStr;
			var timeOut = 300000;
			var timeoutHandle = window.setTimeout(inactive, timeOut);
			var messageID = "";
			
			$("document").ready(function() {
					$("#last_30_DaysMsg").trigger('click');
					$.ajax({
					type: "POST",
					url: "IsLastMessageShown.php",
					}).done(function(response){  
								if (response === '0')
								{
									Blink();
									updateLastMessageShown ();	
								}
								//console.log(response);
								});							
					});
			
			function Blink(){
				var blink = true;
				setInterval(function(){
				var theTitle = document.getElementsByTagName("title")[0];
				if(blink)
				{
					theTitle.text = "New msg!";
					blink = false;
				}
				else
				{
					theTitle.text = "";
					blink = true;
				}
			}, 1000);
			
			}
			
			
			function updateLastMessageShown ()
			{
				$('body').bind('mousedown keydown', function(event) 
				{
						$.ajax({
								type: "POST",
								url: "update_isLastMessageShown.php",
								}).done(function()
											{
											$("#title").html("MSG System!");	
											location.reload(true);
											});							
					
				});
			}
			
			$(':button').css( 'cursor', 'pointer' );
			$('.buttonBig').css( 'cursor', 'pointer' );
			
			$("#showTodayMsg").click(function(event){
						$("#messages").empty();
						messageStr='';
						DateFrom = $.datepicker.formatDate('yy-mm-dd', new Date());
						//console.log(DateFrom);	
						$.ajax({
						type: "POST",
						url: "search.php",
						data : {
				  					DateFrom : DateFrom
				  		}						
						}).done(function(response){
						$("#messages").html(response);
						//alert("Data Loaded: " + DateFrom);
						});	
						})
			
			$("#showAllMsg").click(function(event){
						messageStr='';
						$("#messages").empty();
						DateFrom = '';
						$.ajax({
						url: "search.php",
						}).done(function(response){
						$("#messages").html(response);
						});	
						})
						
			$("#last_30_DaysMsg").click(function(event){
						messageStr='';
						$("#messages").empty();
						DateFrom = new Date();	
						var curr_date = DateFrom.getDate();
						var curr_month = DateFrom.getMonth(); //set DateFrom = 1 month ago 
						var curr_year = DateFrom.getFullYear();
						DateFrom = curr_year + "-" + curr_month + "-" + curr_date; 
						//console.log(DateFrom);					
						$.ajax({
						type: "POST",
						url: "search.php",
						data : {
				  					DateFrom : DateFrom
				  		}	
						}).done(function(response){
						$("#messages").html(response);
						});	
						})
			
			$("#search").click(function(event){
						$("#messages").empty();
						messageStr= $("#messageStr").val();
						DateFrom = $("#DateFrom").val();
						DateTo = $("#DateTo").val();
						$.ajax({
						type: "POST",
						url: "search.php",
						data : {
				  					DateFrom : DateFrom,
				  					DateTo : DateTo,
									messageStr : messageStr
				  		}						
						}).done(function(response){
						$("#messages").html(response);
						}).done(function(){
									$("#DateFrom").val("");
									$("#DateTo").val("");	
									$("#messageStr").val("");		
									});	
						})

			
			$("#editMsg").click(function(event){
												$("#messages").empty();
												
												$.ajax({
														type: "POST",
														url: "EditMsg.php",
														dataType : "json",
														data : 
														{
																DateFrom : DateFrom,
																DateTo : DateTo,
																messageStr : messageStr
														}		
														}).done(EditMessage);						
												})						
																							
			var EditMessage = function(response){
					var info;
					var message;
					var buttonEdit;
					$.each(response, function(index, item)
					{ 	
						info = "<input type='checkbox' value='" + item.msgID +"' name='type'>From: <b>" + item.username + ",</b>  Posted at: "  + item.message_time + " ";
						message = item.message;
						buttonEdit = "<button name='" + item.msgID + "' class='edit' value = '" + item.msgID + "'>Edit</button>";

						$("#messages").append("<div>" + info + buttonEdit + "<h4>" + message + "</h4></div><hr/>");
					})
					$("#messages").append("<p><button class= 'buttonSmall' id='del' value='Delete Messages'>Delete</button></p>");
					$("button[class=edit]").click(function(event){
											messageID = $(this).attr("name")
											var url = "updateMessage.php?msgID=" + messageID ;   
											messageID = "";
											$(location).attr('href',url)
											})	
											
					$("#del").click(function(event){
											var msgIDarray = [];
											console.log("click");
											$("input:checkbox[name=type]:checked").each(function() {
	       											msgIDarray.push($(this).attr("value"));
													console.log($(this).attr("value"));
	  										});

											$.ajax({
														type: "POST",
														url: "DeleteMessage.php",
														dataType : "json",
														data : 
														{
																msgIDarray :msgIDarray
														}
														//success : $(location).attr('href','index.php')										
													})				
														$("#last_30_DaysMsg").trigger('click');			
													})
			
			}			
		
			$(function() {
							$( "#DateFrom" ).datepicker({ dateFormat: 'yy-mm-dd', autoSize: true });
						});	
			$(function() {
							$( "#DateTo" ).datepicker({  dateFormat: 'yy-mm-dd', autoSize: true });
						});
			
	
			// reset reload timer
			$('body'). bind('mousemove, keydown, click, mousedown keydown', function()	{	
																							clearTimeout(timeoutHandle);
																							timeoutHandle = window.setTimeout(inactive, timeOut);
																						})	

			function inactive() {
			    window.location.reload(true);
			}
			
			
