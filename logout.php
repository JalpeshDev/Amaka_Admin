<?php
    session_start();
    if(!$_SESSION["authToken"] && empty($_SESSION['userDetails'])){
        header("Location:login.php");
    }
    session_destroy();
    header("Location:login.php");
?>