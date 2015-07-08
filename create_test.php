<?php
include 'login.php';
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
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
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
    <div class="container col-lg-12">
            <div id="publish-exam-area" class="row">
            <div class="col-lg-6 col-md-6">
                <div class="create-test-area">
                    <form class="form-inline " id="create-test" action="" method="post">
                        <input id="request" hidden type="text" name="REQUEST" value="SHOW_ALL_QUESTIONS"/>
                        <input id="state" hidden type="text" name="state" value="ShowAllQuestions">
                        <input hidden type="text" name="REQUEST" value="J_INSERT_QUESTION_EXAM"/>
                        <input hidden type="text" name="state" value="InsertQuestionIntoExam">
                            <label for="exampleInputName2">Exam Name: </label>
                            <input name="examName" type="text" class="form-control" id="examName" placeholder="Exam Name">
                            <button id="create-test-clear" type="button" class="btn btn-default">Clear Question</button>
                            <button id="create-test-submit" class="btn btn-primary" type="submit" value="submit">Submit</button>
                            <select class="btn btn-default" id="filter">
                                <option>--Filter--</option>
                                <option value="if">if</option>
                                <option value="while">while</option>
                                <option value="for">for</option>
                            </select>
                            <div class="text-success" id="submitted"></div>
                        <div class="column-scroll">            
                            <table class="table table-bordered well column-scroll">
                                <thead>
                                    <tr>
                                      <th>Select</th>
                                      <th>ID</th>
                                      <th>Question Name</th>
                                      <th>Function Type</th>
                                      <th>Variable Name</th>
                                      <th>Question Description</th>
                                    </tr>
                                </thead>
                                <tbody id="questionbank-content"></tbody>
                            </table>
                    </div>
                    </form>
                </div> 
            </div>
            <div class="col-lg-6 col-md-6">
            <div class="create-test-area">
                <label>Number of Questions selected:  <span class="text-primary" id="selected"></span></label>
                        <table id="table-questions" class="table table-bordered well">
                            <thead>
                                <tr>
                                  <th>Question Name</th>
                                  <th>Function Type</th>
                                  <th>Variable Name</th>
                                  <th>Question Description</th>
                                </tr>
                            </thead>
                            <tbody id="preview-content">


                            <tbody>
                        </table>
            </div>
            </div>
        </div>
        <!-- /.container -->
        </div>


        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script>
            var request = new Array();
            var publishresponse = new Array();

        $(document).ready(function(){
            var showallQuestions = $(function(e) {
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
        });
        
        function questionbankTable(publishresponse) {   
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

    $("#filter").change(function(){
        value = $(this).val();
        var filter = "";
        switch(value)
        {
            case "if":
                filter = "if";
                break;
            case "while":
                filter = "while";
                break;
            case "for":
                filter = "for";
                break;
            default:
                filter = "none";
                break;
        }
            
        $("#questionbank-content").empty();

            if(filter != "none")
            {   
                var qnum = 0;
                var i = 0;
                $.each(publishresponse, function(){
                    console.log(publishresponse[i][7]);
                    qnum++;
                    if(publishresponse[i][7] == filter)
                    {
                        $('<tr>').append(
                            $('<td><input id="checkquestion" type="checkbox" name=q' + qnum +' class="check" value=' + publishresponse[i][0] +'></td>'),
                            $('<td>').text(publishresponse[i][0]),
                            $('<td>').text(publishresponse[i][2]),
                            $('<td>').text(publishresponse[i][4]),
                            $('<td>').text(publishresponse[i][5]),
                            $('<td>').text(publishresponse[i][3])
                        ).appendTo('#questionbank-content');
                    }
                    i++
                });
                addquestion();
            }
            else
            {
             questionbankTable(publishresponse);
             addquestion();
            }      
    });

    function addquestion () {
        $('input.check').change(function(){
            if(this.checked){
                var preview = $(this).closest('td').siblings('td').toArray();
                var vals = $(this).val();
                    request.push(vals);
                    console.log(request);
                    $("#selected").html(request.length);
                    showPreview(preview, vals);
            } else {
                var currentval = $(this).val()
                for(var i=0; i<=request.length; i++){
                    if(request[i] == currentval){
                        request.splice(i, 1);
                        $("#selected").html(request.length);
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
        $("#selected").html(request.length);
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
                $('#submitted').html("<h2>Exam was created!</h2>").fadeIn().delay(2000).fadeOut();
                console.log(JSON.stringify(data));
                $('#create-test')[0].reset();
                $("#preview-content").empty();
                request = [];
                $("#selected").html(request.length);
            },

            error: function(data){
                console.log(JSON.stringify(data));
            }   
        });
        return false;
    });

});
        </script>
        <script src="js/admin.js"></script>

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
