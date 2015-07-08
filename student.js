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
					$('<div id="right" class="col-sm-6">').append(
						$('<p>Directions: <span class="text-success">Complete this test or else you will fail.  No repeat exams are permitted unless in the event of an emergency!!!</span></p>'),
						$('<button id="attempt-exam" name='+ showallExams[i][1] +' type="button" class="btn btn-info">Attempt Exam</button>'),
						$('<button id='+ showallExams[i][0] +' name='+ showallExams[i][1] +' type="button" class="btn btn-success check-grade">Check Grade</button>')
					)	
				).appendTo('#exam-list');
			}
			else
				$('#exam-list').html('<h1>There are currently no exams that are available to be taken at the moment!</h1>');
		});
	}

		$(document).on('click', '#attempt-exam', function (e){
		$.support.cors = true;

		var data = {
			"examName" : $(this).attr("name"),
			"REQUEST" : $("#request2").val(),
			"state" : $("#state2").val()
		};

		console.log(data);

		var examName = data.examName;

		$.ajax({
	        url: "curl_mid.php",
	        data: data,
	        type: "POST",
	        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		
	    	success: function(data){
	    		alert("About to Attempt an Exam!");
	    		console.log(data);
	    		window.location.href = 'http://web.njit.edu/~jmm77/490/exam.php?examName=' + examName;

	    		var newdata = new FormData();
                newdata.append("examname", data.examName);
			},

			error: function(data, jqXHR, errorThrown){
				console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
			}	
		});
		return false; 
	});

	$(document).on('click', '.check-grade', function (){
		$.support.cors = true;

		var getId = $(this).attr("id");
		var getName = $(this).attr("name");

		console.log(getId, getName);

		window.location.href = 'http://web.njit.edu/~jmm77/490/grades.php?examId=' + getId +  '&examName=' + getName +'';

	});

		var showStudentGrades = $(function(e) {

		$.support.cors = true;

		var data = {
			"REQUEST" : $("#request9").val(),
			"examName" : $("#examName").val(),
			"student_id" : $("#student_id").val()
		};

		console.log(data);

		$.ajax({
	        url: "curl_mid.php",
	        data: data,
	        type: "POST",
	        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		
	    	success: function(data){
	    		console.log(data);
	    		showStudentGrades = $.parseJSON(data);
	    		console.log(showStudentGrades.variables_grade);
	    		displayGrades(showStudentGrades);
			},

			error: function(data, jqXHR, errorThrown){
				console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
			}	
		});
		return false; 
	});

	function displayGrades(showStudentGrades){
		$.each(showStudentGrades, function(i, item){
			    $('<tr>').append(
       				$('<td>').text(showStudentGrades.function_grade),
				    $('<td>').text(showStudentGrades.syntax_grade),
				    $('<td>').text(showStudentGrades.variables_grade),
				    $('<td>').text(showStudentGrades.answer_grade)
			).appendTo('#grade_table');
		});
	}
});