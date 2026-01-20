<?php
    session_start();

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
        $query = "SELECT tID from VezaKorisnikTrka where kID = {$_SESSION['kID']};";

        $temp = mysqli_query($dbLink, $query);
        if(!$temp)
            die(mysqli_error($dbLink));
        $userRaces = mysqli_fetch_all($temp);

        foreach($_POST["assign"] as $assignmentToToggle){
            $toAdd = true;
            for($i = 0; $i < count($userRaces); $i++){
                if($assignmentToToggle == $userRaces[$i][0]){
                    $toAdd = false;

                    $query = "DELETE from VezaKorisnikTrka 
                    where tID=$assignmentToToggle and kID={$_SESSION['kID']};";

                    if(!mysqli_query($dbLink, $query))
                        die(mysqli_error($dbLink));
                    break;
                }
            }
            if($toAdd){
                $query = "SELECT count(kt.kID), Trke.brojTrkaca FROM Trke
                left join VezaKorisnikTrka as kt on kt.tID = Trke.tID
                where Trke.tID = $assignmentToToggle 
                group by Trke.tID";

                $temp = mysqli_query($dbLink, $query);
                if(!$temp)
                    die(mysqli_error($dbLink));
                $racerNums = mysqli_fetch_all($temp);

                if($racerNums[0][0] >= $racerNums[0][1])
                    continue;

                $query = "INSERT into  VezaKorisnikTrka(tID, kID)
                values ($assignmentToToggle, {$_SESSION['kID']});";

                if(!mysqli_query($dbLink, $query))
                    die(mysqli_error($dbLink));
            }
        }
    }

    if(!empty($_POST["delete"])){
        $implosion = implode(',',$_POST["delete"]);
        $query = "DELETE from VezaKorisnikTrka where tID in (" . $implosion . ");";
        
        if(!mysqli_query($dbLink, $query))
            die(mysqli_error($dbLink));

        $query = "DELETE from Trke where tID in (" . $implosion . ");";
        
        if(!mysqli_query($dbLink, $query))
            die(mysqli_error($dbLink));
    }

    mysqli_close($dbLink);

    header("location: http://$host" . $_SESSION["lastPage"]);
    exit();
?>