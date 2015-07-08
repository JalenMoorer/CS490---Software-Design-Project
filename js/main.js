$(document).ready(function() {

	$('#form').submit(function (e) {
		
		$.support.cors = true;
		e.preventDefault();

		var data = {
			"user" : $("#user").val(),
			"pass" : $("#pass").val(),
			"REQUEST" : "USER_AUTH",
		};

		$.ajax({

			url: "curl_mid.php",
			data: data,
			type: "POST",
			dataType: "json",
			contentType: "application/x-www-form-urlencoded; charset=UTF-8",

			success: function(data) {
				console.log(JSON.stringify(data));
				if(data.isUser == true){

                    var newdata = new FormData();
                    newdata.append("postuser", data.user);
                    newdata.append("postid", data.user_id);

                    var nav = data.nav;

					$.ajax({
					url: "login.php",
					data: newdata,
					type: "POST",
					processData: false,
					contentType: false,
					       	
                	         	
	                success: function(data){
	                	console.log(data);
						window.location.href = nav;
	                },
					error: function (jqXHR, textStatus, errorThrown){
						console.log('Error ' + textStatus + jqXHR.responseText);
					}
				});
				}
				else{
					$('#msg').html("<h2>Username/Password is incorrect</h2>").fadeIn().delay(2000).fadeOut();
				}
			},
		  	error: function (jqXHR, textStatus, errorThrown){
				console.log('Error ' + jqXHR);
			}
		});
		return false;
	});



});
