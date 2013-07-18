

$(document).ready(function() {
  var listId;
 	var listName;

$.ajax({
		type: "POST",
		url: "getRealName.php",
		}).done(function(response){
					if ((response==="login.html"))
						{
							window.location.replace(response);
						}
					else
						{
							$('.userName').html("Hello, "+ response +"!");
						}
				});		


$("#createNewList").click(function(event){
	$("#selectList").empty();
	var	NewListName=$("#newList").val();
				$.ajax({
					type: "POST",
					url: "newList.php",
				  	data : {
				  	NewListName : NewListName
				  }
				}).done(function(response){
					$("#newList").val("");
					});		
	Load();	
	
	})



var Load = function (){
		$.ajax({
				type: "POST",
				url: "loadLists.php",
			  	dataType : "json"
				}).done(function(response){
						$.each(response, function(index, item){ 
						$("#selectList").append("<option value='" + item.listID + "'>" + item.listName + "</option>");
						});		
				});
}


$("#selectList").ready(function(event){
			Load();			
})




$("#selectList").change(function () {

 		$("select option:selected").each(function(event) {
  				listId = $(this).val();
  				listName = $(this).text();
  				//console.log(listId, " ",listName );
  				$.ajax({
						type: "POST",
						url: "loadEmails.php",
				  		dataType : "json",
				  		data : {
				  				listId : listId,
				  				listName : listName	
				  		}
				}).done(LoadEmails).done(LoadSubscribers);				
    });
}).trigger('change');


// add a new email into the selected list
$("#addNewEmail").click(function(event){
							var	newEmail=$("#newEmail").val();
							$.ajax({
									type: "POST",
									url: "addEmail.php",
									dataType : "json",
				  					data : {
				  							newEmail : newEmail,
				  							listId : listId
				 					 }
							}).done(function(response){
								console.log (response);
								$("#newEmail").val("");
								//$(".message").html(response);
							});		
							$("#selectList").trigger("change");
						})


// delete selected list
$("#deleteList").click(function(event){
				$("#selectList").empty();
							$.ajax({
									type: "POST",
									url: "deleteList.php",
				  					dataType : "json",
				  					data : {
				  							listId : listId
				  					}
								})
				console.log(listId);
				Load();	
				listId = "";
				})



var LoadEmails = function (response){
	$("#emails").html("");
		$.each(response, function(index, item){ 
			//console.log(item.emailID, " ",item.email);
			$("#emails").append("<p><input type='checkbox' name='type' id='selectedEmail' value=' "+ item.emailID + " '> " + item.email +  "</p>");
		});
	$("#emails").append("<button class='btn' type='button' id='deleteEmail'>delete</button>");
					$("#deleteEmail").click(function(event){
								var	arraySelectedEmail=[];
								$("input:checkbox[name=type]:checked").each(function() {
	       								arraySelectedEmail.push($(this).val());
	  								});
									//console.log(arraySelectedEmail);
								 
										$.ajax({
												type: "POST",
												url: "deleteEmail.php",
												dataType: "json",
							  					data : {
							  					arraySelectedEmail : arraySelectedEmail
							  					}
										}).done(function(response){
									console.log("ready");

								});		
						$("#selectList").trigger("change");
					})
}

var LoadSubscribers = function (response){
	var subscribers = "";
	$.each(response, function(index, item){ 
			//console.log(item.emailID, " ",item.email);
			subscribers = subscribers + item.email + "; ";
			console.log (item.email);
		});
	subscribers = subscribers.slice(0,-2);
		$("#subscribers").val(subscribers)


}

$("#sendMessage").click(function(event){
	var subject = $("#subject").val();
	var message = $("#message").val();
	var subscribers = $("#subscribers").val();
	var	emptyString = "";
		console.log("send message click");
			if (subscribers!==emptyString)
					{
								if (subject!==emptyString)
									{
										$.ajax({
													type: "POST",
													url: "sendMessage.php",
								  					data : {
								  								subject : subject,
								  								message : message,
								  								subscribers : subscribers
											  				}
														}).done(function(response){
																alert(response);
																$("#subject").val("");
																$("#message").val("");
																$("#subscribers").val("");
												});	
						
									}

								else
									{
										alert("Fill in the Subject Field!");
									}
							
					}
			else
					{
						alert("Select a List of Subscribers!");
					
					}
		


})	




})


