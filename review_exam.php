<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CS490 Alpha</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->


        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/landing-page.css" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo $_SESSION['postuser']; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="admin.php">Admin</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="logout.php">Logout<span class="sr-only">(current)</span></a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<a name="about"></a>
    <div class="text-white">
        <div class="container">
            <div class="row" id="publish-exam-area">
                <div class="col-md-9">
                <form id="exam-form">
                    <div class="page-header">
                        <h1 class="pull-left"><?php echo $_GET['examName']?>   <small>   Each question is out of 100 points each</small></h1>
                        <h1 class="pull-right">Total Grade: <span id="total-test-grade"></span></h1>
                    </div>
                    <input id="studentID" hidden type="text" name="studentID" value=<?php echo $_SESSION['postuser']; ?>>
                    <input id="request2" hidden type="text" name="REQUEST" value="J_SHOW_EXAM"/>
                    <input id="state2" hidden type="text" name="state" value="ShowExam">

                    <input id="request6" hidden type="text" name="REQUEST" value="J_EXAM_TAKEN"/>
                    <input id="request7" hidden type="text" name="REQUEST" value="J_GET_EXAM_BY_ID"/>
                    <input id="state7" hidden type="text" name="state" value="ShowAllExamNum">

                    <input id="request10" hidden type="text" name="REQUEST" value="SHOW_STUDENT_GRADES_BY_EXAM"/>
                    <input id="state10" hidden type="text" name="state" value="ShowStudentGradeByExam">

                    <input id="examName" hidden type="text" name="state" value=<?php echo $_GET['examName']?>>


                    <div style="clear:both;" id="test-content">

                    </div>
                    <div id='loading'></div>
                </form>
                    <div id="instructions" class="intro-message">
                        <input type="hidden" id="examname" name=<?php echo $_GET['examName']?>></h1>
                    </div>
                </div>
                <div class="col-md-3">
                    <nav id="question-nav" class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
                        <ul id="question-nav-list" class="nav bs-docs-sidenav">

                        </ul>
                    </nav>
                </div>
            </div>
        <!-- /.container -->
        </div>
    </div>

        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script>
        $(document).ready(function(){

        testAnswers = new Array();

        var ShowStudentFinalGradeByExam = $(function(e) {
        $.support.cors = true;

        var data = {
            "studentID" : $("#studentID").val(),
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
                //alert("About to Review an Exam!");
                console.log(data);
                testAnswers = $.parseJSON(data);
                displayAnswers(testAnswers);
                //window.location.href = 'http://web.njit.edu/~jmm77/490/review_exam.php?examName=' + examName;

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
                $('<code disabled cols="100" id="my-textarea" class="form-control questionanswer" rows="4">'+ testAnswers[i][11]+'</code>')
            ).appendTo('#test-content');
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
    }

    });
        </script>
        <!--<script src="js/review.js"></script>-->
       
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <!--<script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>-->
    </body>
</html>
