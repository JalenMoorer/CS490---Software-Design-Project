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
                <li class="active"><a href="student.php">Student</a></li>
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
                        <h1><?php echo $_GET['examName']?>    <small>Follow the directions and answer the questions to the best of your ability</small></h1>
                    </div>
                    <input id="studentID" hidden type="text" name="studentID" value=<?php echo $_SESSION['postuser']; ?>>
                    <input id="request2" hidden type="text" name="REQUEST" value="J_SHOW_EXAM"/>
                    <input id="state2" hidden type="text" name="state" value="ShowExam">

                    <input id="request6" hidden type="text" name="REQUEST" value="J_EXAM_TAKEN"/>
                    <input id="request7" hidden type="text" name="REQUEST" value="J_GET_EXAM_BY_ID"/>
                    <input id="state7" hidden type="text" name="state" value="ShowAllExamNum">

                    <input id="request8" hidden type="text" name="state" value="J_SET_STUDENT_EXAM_INFO">
                    <input id="state8" hidden type="text" name="state" value="InsertStudentExamInfo">

                    <input id="examName" hidden type="text" name="state" value=<?php echo $_GET['examName']?>>


                    <div id="test-content">

                    </div>
                    <button class="btn btn-primary" id="show-submit" type="button" value="submit">Complete Test</button>
                    <div class="col-lg-3" style="display: none;" id="submit-test-area">
                        <h2>Are you sure you want to submit this test?</h2>
                        <button class="btn btn-warning " id="hide-submit" type="button" value="submit">Don't Submit</button>
                        <input id="create-test-submit" class="btn btn-primary" type="submit" value="Submit Test"></input>
                        <div id='loading'></div>
                    </div>
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
        <script src="js/exam.js"></script>
       
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
