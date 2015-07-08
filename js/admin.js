$(document).ready(function() {
	
	var request = new Array();
	var publishresponse = new Array();
	var allExams = new Array();
	var variables = new Array();

	$(document).on('click', '#variable-add', function (e){
		e.preventDefault();
		$("#variable-group").append('<input type="text" name="variableName" class="form-control variableName" placeholder="Insert a value that corresponds to each test case value">');
	});

	$(document).on('click', '#delete-field', function (e){
		e.preventDefault();
		$(".variableName:last-child").remove();
	});

	$("#question-form").submit(function (e){

		var variableName = "";
		var variableNameArray = new Array();

		$.support.cors = true;
		e.preventDefault();	

		$("#variable-group > .variableName").each(function(){
			var value = $(this).val();
			variableNameArray.push(value);
			//variableName +=  value +  ','
		});
	    var data = {
	    		"questionName" : $("#questionName").val(),
	    		"instructorID" : $("#instructorID").val(),
	    		"question": $("#question").val(),
	    		"functionName" : $("#functionName").val(),
	    		"variableName" : JSON.stringify(variableNameArray),
	    		"answer" : $("#answer").val(),
	            "REQUEST" : "J_INSERT_QUESTION",
	            "state" : "InsertQuestion",
	        };
	        console.log(data);

	       // assuming this ajax works
	        $.ajax({
	             url: "curl_mid.php",
	             data: data,
	             type: "POST",
	             //dataType: "json",
	             contentType: "application/x-www-form-urlencoded; charset=UTF-8",

				success: function(data){
					$('#submitted').html("<h2>Question was Inserted</h2>").fadeIn().delay(2000).fadeOut();
					$('#question-form')[0].reset();
					console.log(data);
				},
	             error: function (jqXHR, textStatus, errorThrown){
	               console.log('Error' + JSON.stringify(jqXHR.responsetext + errorThrown + textStatus));
	               console.log("bad");
	            }
	        });
	        return false;
	    }); 

	/*var showallQuestions = $(function(e) {
		$.support.cors = true;

		var data = {
			"user_id" : $("#instructorID").val(),
			"REQUEST" : $("#request").val(),
			"state" : $("#state").val()
		};
		console.log(data);

		$.ajax({
	        url: "curl_mid.php",
	        data: data,
	        type: "POST",
	        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		

	    	success: function(data){
	    		console.log(data);
				publishresponse = $.parseJSON(data);				
				questionbankTable(publishresponse);
				addquestion();
			},

			error: function(data, jqXHR, errorThrown){
				console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
			}	
		});
		return false; 
	});*/

	/*function questionbankTable(publishresponse) {	
		var qnum = 0;
		var i = 0;
		$.each(publishresponse, function(){
			qnum++;
				$('<tr>').append(
				$('<td><input id="checkquestion" type="checkbox" name=q' + qnum +' class="check" value=' + publishresponse[i][0] +'></td>'),
				$('<td>').text(publishresponse[i][0]),
				$('<td>').text(publishresponse[i][2]),
				$('<td>').text(publishresponse[i][4]),
				$('<td>').text(publishresponse[i][5]),
				$('<td>').text(publishresponse[i][3])
			).appendTo('#questionbank-content');
			i++
		});
	}

	function addquestion () {
		$('input.check').change(function(){
		    if(this.checked){
				var preview = $(this).closest('td').siblings('td').toArray();
				var vals = $(this).val();
					request.push(vals);
					console.log(request);
					showPreview(preview, vals);
		    } else {
		    	var currentval = $(this).val()
		    	for(var i=0; i<=request.length; i++){
		    		if(request[i] == currentval){
		    			request.splice(i, 1);
		    			hidePreview(currentval);
		    		}
		    	}     
		    }
		});
	}

	function showPreview(preview, vals){
		$("<tr id=" + vals +">").append(
		$('<td>').text(preview[1].innerHTML),
		$('<td>').text(preview[2].innerHTML),
		$('<td>').text(preview[3].innerHTML),
		$('<td>').text(preview[4].innerHTML)
		).appendTo('#preview-content');
	}

	function hidePreview(currentval){
		$("#"+ currentval +"").remove();
	}

	$(document).on('click', '#create-test-clear', function (e){
		e.preventDefault();
		$('#checkquestion').each(function(){
			$("input:checked").removeAttr("checked");
			console.log("check");
		});
		request = [];
		$("#preview-content").empty();
		console.log(request);

	});

	$('#create-test').submit(function (e){
		$.support.cors = true;
		e.preventDefault();	

		//request = $.parseJSON(request);
		request = JSON.stringify(request);	


		var data = {
			"examName" : $("#examName").val(),
			"questionID" : request,
			"REQUEST" : "J_INSERT_QUESTION_EXAM",
			"state" : "InsertQuestionIntoExam"
		};

		console.log(data);

		$.ajax({
	             url: "curl_mid.php",
	             data: data,
	             type: "POST",
	             //dataType: "json",
	             contentType: "application/x-www-form-urlencoded; charset=UTF-8",

			success: function(data){
				$('#submitted').html("<h2>Question was Inserted</h2>").fadeIn().delay(2000).fadeOut();
				console.log(JSON.stringify(data));
				$('#create-test')[0].reset();
				$("#preview-content").empty();
				request = [];
			},

			error: function(data){
				console.log(JSON.stringify(data));
			}	
		});
		return false;
	});
*/
	var showallExams = $(function(e) {
		$.support.cors = true;

		var data = {
			"REQUEST" : $("form#showallexams > #request").val(),
			"state" : $("#showallexams > #state").val()
		};
		console.log(data);

		$.ajax({
	        url: "curl_mid.php",
	        data: data,
	        type: "POST",
	        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		

	    	success: function(data){
	    		console.log(JSON.stringify(data));
				allExams = $.parseJSON(data);
				examDrafts(allExams);

			},

			error: function(data, jqXHR, errorThrown){
				console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
			}	
		});
		return false; 
	});
	function examDrafts(allExams) {
		var i = 0;

		$.each(allExams, function(i, item){
			$('<ul id="exam-info" name='+ allExams[i][1] +' class="list-inline well">').append(
			$('<li>Exam Name: <span class="text-primary">'+ allExams[i][1] +'</span> </li><br>'),
			$('<li>Status: <span id="exam-status" class="">' + showStatus(allExams, i) + '</span> </li><br>'),
			$('<li>Exam Number: <span class="text-primary">'+ allExams[i][0] +'</span> </li><br>'),
			$('<li><button id="preview-click" name='+ allExams[i][1] +' value='+ allExams[i][0] + ' type="button" class="btn btn-info">Preview</button></li>'),
			$('<li><button id="publish-click" name='+ allExams[i][1] +' type="button" class="btn btn-success">Publish</button></li>'),
			$('<li><button id="unpublish-click" name='+ allExams[i][1]+' type="button" class="btn btn-warning">Unpublish</button></li>'),
			$('<li><button id="delete-click" name='+ allExams[i][1]+' type="button" class="btn btn-danger">Delete</button></li>')
			).appendTo('#exam-list');
			i++;
		});
	}

	function showStatus(allExams, i){
		if(allExams[i][2] == 'Yes')
		{
			return "Published";
		}
		else
		{	
			return "Unpublished";
		}
	}

	$(document).on("click", "#preview-click, #publish-click, #unpublish-click, #delete-click", function () {
		$.support.cors = true;

		var buttonClick = $(this).attr("id");
		var examName = $(this).attr("name");
		var msg = '';

		switch(buttonClick)
		{
			case "preview-click":
				console.log("preview-click was clicked!");
				window.location.href = "http://web.njit.edu/~jmm77/490/preview.php?examName=" + $(this).attr("name");
				break;
			case "publish-click":
				console.log("publish-click was clicked!");
				var request = $("#request4").val();
				var state = $("#state4").val();
				msg += 'Exam was published'; 
				break;
			case "unpublish-click":
				console.log("UNpublish-click was clicked!");
				var request = $("#request5").val();
				var state = $("#state5").val();
				msg += 'Exam was unpublished'; 
				break;
			case "delete-click":
				console.log("delete-click was clicked!");
				var request = $("#request6").val();
				var state = $("#state6").val();
				msg += 'Exam was deleted'; 
				console.log(examName);
				removeExam(examName);
				break;
		}

		var data = {
			"examName" : $(this).attr("name"),
			"REQUEST" : request,
			"state" : state
		};

		console.log(data);

		$.ajax({
	        url: "curl_mid.php",
	        data: data,
	        type: "POST",
	        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		
	    	success: function(data){
	    		console.log(data);
	    		$('.message').show().html('<span class="text-primary">'+ msg +'</span>').delay(2000);

	    		setTimeout(function () {
	    			window.location.href = 'https://web.njit.edu/~jmm77/490/publish_test.php';
	    		}, 2000);
			},

			error: function(data, jqXHR, errorThrown){
				console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown );
			}	
		});
		return false;
	});

	function removeExam(examName){
		console.log("Called!");
		$("#exam-list > #exam-info").each(function(){
			if($(this).attr("name") == examName)
			{
				console.log("remove this");
			}
		});
	}
});
