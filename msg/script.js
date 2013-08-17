
			$("document").ready(function() {
					$("#showTodayMsg").trigger('click');
					
					$.ajax({
					type: "POST",
					url: "IsLastMessageShown.php",
					}).done(function(response){  
								if (response === '0')
								{
									//$("#title").html("New msg!");
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
					//or theTitle.innerHTML = "New msg!";
					blink = false;
				}
				else
				{
					theTitle.text = "";
					//or theTitle.innerHTML = "";
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
						var DateFrom = $.datepicker.formatDate('yy-mm-dd', new Date());
						$.ajax({
						type: "POST",
						url: "SearchMsg.php",
						data : {
				  					DateFrom : DateFrom
				  		}						
						}).done(function(response){
						$("#messages").html(response);
						//alert("Data Loaded: " + DateFrom);
						});	
						})
			
			$("#showAllMsg").click(function(event){
						$("#messages").empty();
						$.ajax({
						url: "SearchMsg.php",
						}).done(function(response){
						$("#messages").html(response);
						});	
						})
						
			$("#searchMsg").click(function(event){
						$("#messages").empty();
						var DateFrom = $("#DateFrom").val();
						var DateTo = $("#DateTo").val();
						//console.log(DateTo);
						//console.log(DateFrom);
						$.ajax({
						type: "POST",
						url: "SearchMsg.php",
						data : {
				  					DateFrom : DateFrom,
				  					DateTo : DateTo
				  		}						
						}).done(function(response){
						$("#messages").html(response);
						}).done(function(){
									$("#DateFrom").val("");;	
									$("#DateTo").val("");;									
									});	
						})

			$("#editMsg").click(function(event){
						$("#messages").empty();
						$.ajax({
								url: "EditMsg.php",
								}).done(function(response){
									$("#messages").html(response);
									});	
						})

			$(function() {
							$( "#DateFrom" ).datepicker({ dateFormat: 'yy-mm-dd', autoSize: true });
						});	
			$(function() {
							$( "#DateTo" ).datepicker({  dateFormat: 'yy-mm-dd', autoSize: true });
						});
			
			
			setTimeout(function(){
				   window.location.reload(1);
				   
				}, 300000);
				

			
	
