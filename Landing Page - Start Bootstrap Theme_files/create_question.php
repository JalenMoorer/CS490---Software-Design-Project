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
    
        <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <form role="form" class="form-horizontal" id="question-form" name="question-form" action="" method="POST" novalidate="novalidate">
                            <div class="form-group">
                                <label for="question-name" class="col-sm-2 control-label">Instructor ID: <?php echo $_SESSION['postid'] ?></label>
                                <div class="col-sm-2">
                                    <input type="hidden" value=<?php echo $_SESSION['postid'] ?> class="form-control" id="instructorID" placeholder=<?php echo $_SESSION['user_id'] ?> disabled>
                                    <input hidden type="text" name="REQUEST" value="TEST"/>
                                    <input hidden type="text" name="state" value="InsertQuestion">
                                </div>
                            </div>
                              <div class="form-group">
                                <label for="question-description" class="col-sm-2 control-label">Question Description</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="question" rows="3" id="question" placeholder="Insert Question Description Here"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="question-name" class="col-sm-2 control-label">Function Name</label>
                                <div class="col-sm-6">
                                  <input type="text" class="form-control" name="functionName" id="functionName" placeholder="Insert The Name of The Function">
                                </div>
                            </div>
                            <div class="form-group inline">
                                <label for="question-name" class="col-sm-2 control-label">Variables</label>
                                <div class="col-sm-2">
                                    <input type="text" name="variableName" class="form-control" id="variableName" placeholder="Insert a variable">
                                </div>
                                <div class="col-sm-1">
                                    <button id="variable-add" class="btn btn-primary notop-margin" value="Add">Add</button>
                                </div>
                                <div class="col-sm-2"> 
                                        <div id="added"> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="question-name" class="col-sm-2 control-label">Answer</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer To The Current Question">
                                </div>
                            </div>                                                                                    
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
    <script src="js/vendor/jquery-1.11.2.min.js"></script>
    <script src="js/jquery.validate.js"></script>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/admin.js"></script>
        <script>
        $(document).ready(function() {
        $("#question-form").validate({
        rules: {
                question: "required",
                functionName: "required",
                Variables: "required",
                answer:"required"
            },
        messages: {
                firstname: "Please enter your question",
                functionName: "Please enter a function name",
                Variables: "Please enter a variable",
                answer: "Please accept our policy"
        },
            submitHandler: function(form, e) {
            e.preventDefault();

        }
    });
});
        </script>
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
