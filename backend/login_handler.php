<?php
    session_start();
    include_once("connect_to_database.php");

    $query = "
    select kID, admin from Korisnici 
    where korisnickoIme = '" . $_POST["username"] . "' and sifra = '" . $_POST["password"] . "'";
    
    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $result = mysqli_fetch_all($temp);

    if(empty($result)){
        mysqli_close($dbLink);
        $_SESSION["badlogin"] = true;
        header("Location: http://$host/KartingIS/frontend/login.php");
        die();
    }

    mysqli_close($dbLink);

    $_SESSION["kID"] = $result[0][0];
    $_SESSION["admin"] = $result[0][1];
    header("location: http://$host" . $_SESSION["lastPage"]);
    die();
?>