<?php
session_start();
?>

<!doctype html>
<html  class="no-js" lang="">
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
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>

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
                <li class=""><a href="student.php">Student</a></li>
                <li class="active"><a href="#">Grades</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="logout.php">Logout<span class="sr-only">(current)</span></a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
        <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="publish-exam-area">
                            <form>
                                <input id="examId" hidden type="text" name="examId" value=<?php echo $_GET['examId']?>>
                                <input id="student_id" hidden type="text" name="student_id" value=<?php echo $_SESSION['postuser']?>>
                                <input id="examName" hidden type="text" name="examName" value=<?php echo $_GET['examName']?>>

                                <input id="request9" hidden type="text" name="request" value="J_SHOW_STUDENT_FINAL_GRADE_BY_EXAM">
                                <input id="state9" hidden type="text" name="state" value="ShowStudentFinalGradeByExam">

                                <input id="request10" hidden type="text" name="REQUEST" value="SHOW_STUDENT_GRADES_BY_EXAM"/>
                                <input id="state10" hidden type="text" name="state" value="ShowStudentGradeByExam">                           
                            </form>
                            <div class="col-lg-4">
                                <h2 class="text-center text-primary">Exam Name</h2>
                                <h3 class=" text-center" id="examName-final"></p>
                            </div>
                            <div class="col-lg-4">
                                <h2 class=" text-center  text-primary">Grade</h2>
                                <h3 class=" text-center" id="examGrade-final"></p>
                           </div>
                            <div class="col-lg-4">
                                <h2 class=" text-center text-primary">Feedback</h2>
                                <h3 class=" text-center" id="examFeedback-final"></p>
                            </div>
                            <div id="showbutton" class="col-log-4 text-center">
                                <button style="margin-top:30px" id="show-detailed-grade" class="btn btn-primary text-center" type="button" value="show-detailed-grade">Show Detailed Grade</button>
                            </div>
                            <div id="detailed-grade" style="display:none;" id="detailed-grade">

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <script src="js/vendor/jquery-1.11.2.min.js"></script>
    <script src="js/jquery.validate.js"></script>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/student.js"></script>
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
