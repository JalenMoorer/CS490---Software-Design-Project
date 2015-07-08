<?php
//lets rule out the back-end as problem source
?>
<!doctype>
<html>
    <head>
        <title>Jalen's</title>
    </head>
    <body>
        <h3>Show all questions form</h3>
        <form action="https://web.njit.edu/~rm362/cs490/index.php" method="post">
            <input hidden type="text" name="REQUEST" value="SHOW_ALL_QUESTIONS"/>
            <input hidden type="text" name="state" value="ShowAllQuestions">
            <label>test field</label> <input type="text" name="extra"><br>
            <button>submit</button>
        </form>
    </body>
</html>
