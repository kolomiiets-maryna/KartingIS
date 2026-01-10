<?php
    session_start();

    if(empty($_SESSION["kID"])){
        header("location: http://localhost/KartingIS/frontend/main.php");
        exit();
    }

    if(empty($_POST))
        die("No post recieved");


    $startTime = new DateTimeImmutable ($_POST["datum"]. " " . $_POST["vrijeme"]);

    if($startTime < new DateTimeImmutable()){
        $_SESSION["RaceRegError"] = "Dati termin je u proslosti";
        header("location: http://localhost" . $_SESSION["lastPage"]);
        exit();
    }

    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje: " . mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));
    
    $query = "select pID, brojTrkaca, datumIVrijeme, brojLapova, vID from Trke
    where DATE(datumIVrijeme) = '{$_POST['datum']}';";

    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $races = mysqli_fetch_all($temp);

    $query = "select duzina from Putanje";

    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $trackLengths = mysqli_fetch_all($temp);

    $query = "select brojDostupnih from vozila where vID = {$_POST['vozila']}";

    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $availableKarts = mysqli_fetch_all($temp)[0][0];

    $endTime = $startTime->add(new DateInterval('PT' . (int)($_POST['lapovi'] * ($trackLengths[$_POST["putanja"]-1][0] / 500)) . 'M'));

    for ($i = 0; $i < count($races); $i++){
        $temp = new DateTimeImmutable($races[$i][2]);
        $temp2 = $temp->add(new DateInterval('PT' .(int)($races[$i][3] * ($trackLengths[$races[$i][0]-1][0] / 500)). 'M'));

        if($startTime >= $temp2 || $endTime <= $temp)
            continue;

        if($_POST["putanja"] == $races[$i][0]){
            $_SESSION["RaceRegError"] = "Putanja je zauzeta u datom terminu";
            header("location: http://localhost" . $_SESSION["lastPage"]);
            exit();
        }

        if($races[$i][4] == $_POST["vozila"])
            $availableKarts -= $races[$i][1];
    }

    if($availableKarts < $_POST["broj_ucesnika"]){
        $_SESSION["RaceRegError"] = "Nije dostupan dovoljan broj vozila u datom terminu";
        header("location: http://localhost" . $_SESSION["lastPage"]);
        exit();
    }

    $query = "insert into Trke (pID, vID, brojTrkaca, datumIVrijeme, brojLapova)
    values ({$_POST['putanja']},{$_POST['vozila']},{$_POST['broj_ucesnika']},
    '{$_POST['datum']} {$_POST['vrijeme']}', {$_POST['lapovi']});";

    if(!mysqli_query($dbLink, $query))
        die(mysqli_error($dbLink));

    mysqli_close($dbLink);

    $_SESSION["RaceRegSuccess"] = "Uspjesno zakazana trka";
    header("location: http://localhost" . $_SESSION["lastPage"]);
    exit();
?>