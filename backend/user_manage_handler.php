<?php
    session_start();
    $host = $_SERVER['HTTP_HOST'];

    if(empty($_SESSION["kID"])){
        header("location: http://$host/KartingIS/frontend/main.php");
        exit();
    }

    if(empty($_POST)){
        header("location: http://$host" . $_SESSION["lastPage"]);
        exit();
    }

    include_once("connect_to_database.php");
    
    if(!empty($_POST["assign"])){
        $query = "UPDATE Korisnici as k
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

        $query = "DELETE from Korisnici where kID in (" . $implosion . ");";
        
        if(!mysqli_query($dbLink, $query))
            die(mysqli_error($dbLink));
    }

    mysqli_close($dbLink);

    header("location: http://$host" . $_SESSION["lastPage"]);
    exit();
?>