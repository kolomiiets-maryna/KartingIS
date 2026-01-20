<?php
    session_start();

    if(empty($_POST))
        die("No post recieved");

    include_once("connect_to_database.php");

    $query = "
    insert into Korisnici (korisnickoIme, sifra, rodjendan, tel, email, brojTrka, bestLapTime, lastPresent, admin)
    values ('{$_POST['username']}', '{$_POST['password']}', '{$_POST['birthday']}', 
    '{$_POST['phone']}', '{$_POST['email']}', 0, 0, CURRENT_DATE(), false);";

    if(!mysqli_query($dbLink, $query))
        die(mysqli_error($dbLink));
    
    $_SESSION["kID"] = mysqli_insert_id($dbLink);
    $_SESSION["admin"] = false;

    mysqli_close($dbLink);

    header("location: http://$host" . $_SESSION["lastPage"]);
    exit();
?>