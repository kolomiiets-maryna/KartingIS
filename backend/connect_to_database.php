<?php
    $host = $_SERVER['HTTP_HOST'];

    $dbLink = mysqli_connect("$host","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje sa bazom: " . mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));
?>