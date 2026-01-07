<?php
    session_start();

    if(empty($_POST))
        die("No post recieved (skill issue)");

    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje sa bazom: " . mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));

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
        header("Location: http://localhost/KartingIS/frontend/login.php");
        die();
    }

    mysqli_close($dbLink);

    $_SESSION["kID"] = $result[0][0];
    $_SESSION["admin"] = $result[0][1];
    header("location: http://localhost" . $_SESSION["lastPage"]);
    die();
?>