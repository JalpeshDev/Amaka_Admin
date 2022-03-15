<?php
    session_start();
    $baseUrl = "http://192.168.1.205:51000/api/";
    $baseUrlFile = "http://192.168.1.205:51000/";
    if(!isset($_SESSION["authToken"]) && !isset($_SESSION['userDetails']) || $_SESSION['userDetails']['data']['userRoles'] != 3){
        header("Location:../../login.php");
    }
?>