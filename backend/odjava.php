<?php
    session_start();
    unset($_SESSION["kID"]);
    unset($_SESSION["admin"]);
    header("location: http://localhost" . $_SESSION["lastPage"]);
    exit();
?>