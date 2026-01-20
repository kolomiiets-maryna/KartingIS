<?php
    session_start();
    $host = $_SERVER['HTTP_HOST'];

    unset($_SESSION["kID"]);
    unset($_SESSION["admin"]);
    header("location: http://$host" . $_SESSION["lastPage"]);
    exit();
?>