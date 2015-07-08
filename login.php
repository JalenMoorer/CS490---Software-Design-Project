<?php
session_start();
    if(isset($_POST['postuser']))
    {
        $_SESSION['postid'] = $_POST['postid'];
        $_SESSION['postuser'] = $_POST['postuser'];
    }

?>
