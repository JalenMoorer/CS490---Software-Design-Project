$(document).ready(function() {

	var allExams = new Array();
	var showStudentGrades = new Array();
	var testAnswers = new Array();

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

	    		console.log(data);
	    		window.location.href = 'http://web.njit.edu/~jmm77/490/exam.php?examName=' + examName;
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
			"state" : $("#state9").val(),
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
	    		displayFinalGrades(showStudentGrades);
	    		console.log(showStudentGrades[0].id);
			},

			error: function(data, jqXHR, errorThrown){
				console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
			}	
		});
		return false; 
	});

	function displayFinalGrades(showStudentGrades){
		if(showStudentGrades[0][4] == 1){
			$("#examName-final").html(showStudentGrades[0][0]);
			$("#examGrade-final").html(showStudentGrades[0][2]);
			$("#examFeedback-final").html(showStudentGrades[0][3]);
		}
		else{
			$("#examGrade-final").html("This test has not been released yet")
			$("#show-detailed-grade").css("visibility", "hidden");
		}
	}

	$(document).on('click', '#show-detailed-grade', function (){
		$.support.cors = true;

        var data = {
            "student_id" : $("#studentID").val(),
            "examName" : $("#examName").val(),
            "REQUEST" : $("#request10").val(),
            "state" : $("#state10").val()
        };

        console.log(data);

        var examName = data.examName;

        $.ajax({
            url: "curl_mid.php",
            data: data,
            type: "POST",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        
            success: function(data){

                console.log(data);
                testAnswers = $.parseJSON(data);
                displayAnswers(testAnswers);

                var newdata = new FormData();
                newdata.append("examname", data.examName);
            },

            error: function(data, jqXHR, errorThrown){
                console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
            }   
        });
        return false; 
    });

    function displayAnswers(testAnswers){
        var qnum = 0; var i = 0; var total = 0;
        $.each(testAnswers, function(){
            console.log("true");
            qnum++;
            $('<div class="form-group exam-question-item">').append(
                $('<label id=' + qnum + '  for="question">').text("Question # " + qnum),
                $('<label>').text("Points: "),
                $('<label class="flex text-primary">').text("Total Grade: " + testAnswers[i][8] + " Out of 100"),
                $('<label class="flex text-default">').text("Function Grade: " + testAnswers[i][4] + " Out of 100"),
                $('<label class="flex text-default">').text("Syntax Grade: " + testAnswers[i][5] + " Out of 100"),
                $('<label class="flex text-default">').text("Variable Grade: " + testAnswers[i][6] + " Out of 100"),
                $('<label class="flex text-default">').text("Answer Accuracy Grade: " + testAnswers[i][7] + " Out of 100"), 
                $('<code disabled cols="100" id="my-textarea" class="form-control questionanswer" rows="4">'+ decodeURIComponent(testAnswers[i][11])+'</code>')
            ).appendTo('#detailed-grade');
            i++;
        });
        for(var i = 0; i<testAnswers.length; i++){
            var num = parseInt(testAnswers[i][8]);
            total = num + total;
        }
        var testTotal = testAnswers.length * 100;
        var totalGrade = total/testTotal * 100;
        var gradeLetter = "";

        switch(totalGrade)
        {
            case totalGrade<=100:
                gradeLetter = "A";
                break;
            case totalGrade<=80:
                gradeLetter = "B";
                break;
            case totalGrade<=70:
                gradeLetter = "C";
                break;
            case totalGrade<=60:
                gradeLetter = "D";
                break;
            case totalGrade<=50:
                gradeLetter = "F";
                break;
        }
        $('#total-test-grade').html(totalGrade+"%");
        $("#detailed-grade").show()
        $("#show-detailed-grade").hide();
    }
});