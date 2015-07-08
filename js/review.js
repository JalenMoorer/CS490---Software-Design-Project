$(document).ready(function() {
	var allExams = new Array();

	//$(document).on('click', '#preview-click', function (e){
	var showallExams = $(function(e) {

		$.support.cors = true;

		var data = {
			"REQUEST" : $("#request3").val(),
			"state" : $("#state3").val()
		};

		console.log(data);

		$.ajax({
	        url: "curl_mid.php",
	        data: data,
	        type: "POST",
	        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		
	    	success: function(data){
	    		console.log(data);
	    		showallExams = $.parseJSON(data);
				exams(showallExams);
			},

			error: function(data, jqXHR, errorThrown){
				console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
			}	
		});
		return false; 
	});

	 function exams (showallExams){
		$.each(showallExams, function(i, item){
			if(showallExams[i][2] == 'Yes'){
				$('<div id="exam-item" class="well row">').append(
					$('<div id="left" class="col-sm-5">').append(
			 			$('<ul id="exam-info" class="list-inline">').append(
							$('<li>Exam Name: <span class="text-success">' + showallExams[i][1] +'</span></li><br>'),
							$('<li>Exam Number: <span class="text-success">'+ showallExams[i][0] +'</span></li><br>')
						)
					),
					$('<div id="right" class="col-sm-7">').append(
						$('<button id="check-grades" name='+ showallExams[i][1] +' type="button" class="btn btn-info">Check Grades</button>'),
						$('<button id="release-grades" name='+ showallExams[i][1] +' type="button" class="btn btn-success check-grade">Release Detailed Grades</button>'),
						$('<button id="final-release-grades" name='+ showallExams[i][1] +' type="button" class="btn btn-success check-grade">Release Final Grades</button>')
					)	
				).appendTo('#exam-list');
			}
			else
				$('#exam-list').html('<h1>There are currently no exams that are available to be taken at the moment!</h1>');
		});
	}

		$(document).on('click', '#check-grades', function (e){
		$.support.cors = true;
		var getName = $(this).attr("name");

		var data = {
			"examName" : getName,
			//"REQUEST" : $("#request10").val(),
			//"state" : $("#state10").val()
		};

		console.log(data);

		var examName = data.examName;

		$.ajax({
	        url: "curl_mid.php",
	        data: data,
	        type: "POST",
	        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		
	    	success: function(data){
	    		window.location.href = 'http://web.njit.edu/~jmm77/490/review_exam.php?examName=' + examName;
			},

			error: function(data, jqXHR, errorThrown){
				console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
			}	
		});
		return false; 
	});

	$(document).on('click', '#release-grades', function (e){
		$.support.cors = true;

		var getName = $(this).attr("name");
		var msg = '';
		msg += 'Exam grades released!';

		var data = {
			"examName" : getName,
			"REQUEST" : $("#request11").val(),	
			"state" : $("#state11").val(),
		};

		console.log(data);

		$.ajax({
	        url: "curl_mid.php",
	        data: data,
	        type: "POST",
	        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		
	    	success: function(data){
	    		$('.message').html('<span class="text-primary">'+ msg +'</span>').show(0).delay(2000).fadeOut(0);
	    		console.log(data);
			},

			error: function(data, jqXHR, errorThrown){
				console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
			}	
		});
		return false; 
	});

		$(document).on('click', '#final-release-grades', function (e){
		$.support.cors = true;

		var getName = $(this).attr("name");
		var msg = '';
		msg += 'Exam Final grades released!';

		var data = {
			"examName" : getName,
			"REQUEST" : $("#request12").val(),	
			"state" : $("#state12").val(),
		};

		console.log(data);

		$.ajax({
	        url: "curl_mid.php",
	        data: data,
	        type: "POST",
	        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		
	    	success: function(data){
	    		$('.message').html('<span class="text-primary">'+ msg +'</span>').show(0).delay(2000).fadeOut(0);
	    		console.log(data);
			},

			error: function(data, jqXHR, errorThrown){
				console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
			}	
		});
		return false; 
	});
});


