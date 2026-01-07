<?php
    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje: " . mysqli_error($dbLink));
    
    echo "Uspjesno povezivanje sa bazom <br>";

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));
    
    echo "Populisanje baze sa gotovim podaciam.... <br>";

    $query = "
    insert into Korisnici (korisnickoIme, sifra, godine, rodjendan, tel, email, brojTrka, bestLapTime, lastPresent, admin)
    values ('Admin', '123', 99, '2004-02-13', '067167129', 'testmail@gmail.com', 1, 2, '2026-02-13', true);
    ";

    if(!mysqli_query($dbLink, $query))
        die(mysqli_error($dbLink));

    $query = "
    insert into Putanje (naziv, duzina)
    values ('Putanja 1', 1000), ('Putanja 2', 1500), ('Putanja 3', 1250);
    ";

    if(!mysqli_query($dbLink, $query))
        die(mysqli_error($dbLink));

    $query = "
    insert into Vozila (naziv, broj, brojDostupnih)
    values ('LR5', 15, 10), ('RT8', 20, 18), ('2DRIVE', 5, 4);
    ";

    if(!mysqli_query($dbLink, $query))
        die(mysqli_error($dbLink));

    $query = "
    insert into Cijene (pID, vID, cijena)
    values  (1,1,1.0),(1,2,1.5),(1,3,2.0),
            (2,1,1.5),(2,2,2.0),(2,3,2.5),
            (3,1,1.25),(3,2,1.75),(3,3,2.25);
    ";

    if(!mysqli_query($dbLink, $query))
        die(mysqli_error($dbLink));

    echo "Gotovo!";
    mysqli_close($dbLink);
?>