<?php
    session_start();

    if(empty($_SESSION["kID"])){
        header("location: http://localhost/KartingIS/frontend/main.php");
        exit();
    }

    if(empty($_POST)){
        header("location: http://localhost" . $_SESSION["lastPage"]);
        exit();
    }

    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje: " . mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));
    
    if(!empty($_POST["assign"])){
        $query = "UPDATE korisnici as k
        set k.admin = NOT k.admin
        where k.kID in (" . implode(',',$_POST["assign"]) . ");";
        
        if(!mysqli_query($dbLink, $query))
            die(mysqli_error($dbLink));
    }

    if(!empty($_POST["delete"])){
        $implosion = implode(',',$_POST["delete"]);
        $query = "DELETE from VezaKorisnikTrka where kID in (" . $implosion . ");";
        
        if(!mysqli_query($dbLink, $query))
            die(mysqli_error($dbLink));

        $query = "DELETE from korisnici where kID in (" . $implosion . ");";
        
        if(!mysqli_query($dbLink, $query))
            die(mysqli_error($dbLink));
    }

    mysqli_close($dbLink);

    header("location: http://localhost" . $_SESSION["lastPage"]);
    exit();
?>