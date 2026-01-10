<?php
    session_start();

    if(empty($_POST))
        die("No post recieved");

    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje: " . mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));

    $query = "
    insert into Korisnici (korisnickoIme, sifra, rodjendan, tel, email, brojTrka, bestLapTime, lastPresent, admin)
    values ('{$_POST['username']}', '{$_POST['password']}', '{$_POST['birthday']}', 
    '{$_POST['phone']}', '{$_POST['email']}', 0, 0, CURRENT_DATE(), false);";

    if(!mysqli_query($dbLink, $query))
        die(mysqli_error($dbLink));
    
    $_SESSION["kID"] = mysqli_insert_id($dbLink);
    $_SESSION["admin"] = false;

    mysqli_close($dbLink);

    header("location: http://localhost" . $_SESSION["lastPage"]);
    exit();
?>