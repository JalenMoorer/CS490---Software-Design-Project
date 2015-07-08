    function insertTab(o, e)
    {
        var kC = e.keyCode ? e.keyCode : e.charCode ? e.charCode : e.which;
        if (kC == 9 && !e.shiftKey && !e.ctrlKey && !e.altKey)
        {
            var oS = o.scrollTop;
            if (o.setSelectionRange)
            {
                var sS = o.selectionStart;
                var sE = o.selectionEnd;
                o.value = o.value.substring(0, sS) + "\t" + o.value.substr(sE);
                o.setSelectionRange(sS + 1, sS + 1);
                o.focus();
            }
            else if (o.createTextRange)
            {
                document.selection.createRange().text = "\t";
                e.returnValue = false;
            }
            o.scrollTop = oS;
            if (e.preventDefault)
            {
                e.preventDefault();
            }
            return false;
        }
        return true;
    }

$(document).ready(function() {

    var publishresponse = new Array();
    var EXAM = "";

    var showallQuestions = $(function(e) {
        $.support.cors = true;

        var data = {
            "examName": $("#examname").attr("name"),
            "REQUEST": $("#request2").val(),
            "state": $("#state2").val()
        };

        EXAM = data.examName;
        console.log(data);
        console.log(EXAM);

        $.ajax({
            url: "curl_mid.php",
            data: data,
            type: "POST",
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",

            success: function(data) {
                publishresponse = data;
                console.log(publishresponse);
                insertQuestion(publishresponse);
            },

            error: function(data, jqXHR, errorThrown) {
                console.log(JSON.stringify(data) + data + jqXHR.responsetext + errorThrown);
            }
        });
        return false;
    });

    function insertQuestion(publishresponse) {
        var qnum = 0;
        var i = 0;
        $.each(publishresponse, function() {
                console.log("true");
                qnum++;
                $('<div class="form-group exam-question-item">').append(
                    $('<label id=' + qnum + '  for="question">').text("Question # " + qnum),
                    $('<label for="">').html("<small>:  " + publishresponse[i][2] + "</small>"),
                    $('<br><label for="">').html("<small><i>Directions:   " + publishresponse[i][3] + "</i></small>"),
                    $('<br><label for="">').html("<small><i>Function to use:   " + publishresponse[i][4] + "</i></small>"),
                    //$('<br><label for="">').html("<small><i>Variables to use:   " + publishresponse[i][5] + "</i></small>"),
                    $('<textarea onkeydown="insertTab(this, event);" id="my-textarea" class="form-control questionanswer" rows="3" placeholder="Insert Answer Here"></textarea>')
                ).appendTo('#test-content');
                questionNavigation(publishresponse, qnum);
                insertIds(publishresponse);
            i++;
        });
        //insertExamId(publishresponse);
    }

    function questionNavigation(publishresponse, qnum) {
        $('<li class><a href=#' + qnum + '> Question #: ' + qnum + '</li>').appendTo('#question-nav-list');
    }

   function insertIds(publishresponse) {
        var i = 0;
        $('textarea.questionanswer').each(function() {
            $(this).attr("id", publishresponse[i][1]);
            i++;
        });
    }

    $(document).on('click', '#show-submit', function (e){
        $("#submit-test-area").css("display", "initial");
        $("#show-submit").css("display", "none");
    });

    $(document).on('click', '#hide-submit', function (e){
        $("#submit-test-area").css("display", "none");
        $("#show-submit").css("display", "initial");
    });

    

    $("#exam-form").submit(function(e) {

        var answers = {};

        $.support.cors = true;
        e.preventDefault();

        $("textarea.questionanswer").each(function() {
            answers[$(this).attr('id')] = $(this).val();
        });


        console.log(answers);

        var data = {
            "studentID": $("#studentID").val(),
            "examName": $("#examName").val(),
            "examID": $("#examID").val(),
            "answers": JSON.stringify(answers),
            "REQUEST": $("#request8").val(),
            "state": $("#state8").val()
            //"SOURCE": "RM362",
        };

        $.ajax({
            url: "curl_mid.php",
            data: data,
            type: "POST",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",

            beforeSend: function () {
                $("#loading").html('<img src="img/ajax-loader.gif" />');
            },

            success: function(data) {
                console.log(data);
                window.location.href = 'https://web.njit.edu/~jmm77/490/student.php';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error' + JSON.stringify(jqXHR.responsetext + errorThrown + textStatus));
            }
        });
        return false;
    });
});

