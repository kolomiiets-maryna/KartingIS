<?php
    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje: " . mysqli_error($dbLink));
    
    echo "Uspjesno povezivanje sa bazom <br>";

    $query = "create database if not exists KartingIS";

    if(!mysqli_query($dbLink, $query))
        die(mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));

    if(!mysqli_query($dbLink, $query))
        die(mysqli_error($dbLink));

    $query = "
    create table if not exists Korisnici(
        kID mediumint UNSIGNED AUTO_INCREMENT,
        korisnickoIme varchar(20) not null,
        sifra varchar(20) not null,
        rodjendan date not null,
        tel varchar(12),
        eMail varchar(64) not null,
        brojTrka smallint UNSIGNED,
        bestLapTime float(12),
        lastPresent date,
        admin boolean not null,
        primary key (kID)
    );

    create table if not exists Vozila(
        vID tinyint UNSIGNED auto_increment,
        naziv varchar(15) not null,
        broj tinyint UNSIGNED not null,
        brojDostupnih tinyint UNSIGNED not null,
        primary key (vID)
    );

    create table if not exists Putanje(
        pID tinyint UNSIGNED auto_increment,
        naziv varchar(20) not null,
        duzina smallint UNSIGNED not null,
        primary key (pID)
    );

    create table if not exists Trke(
        tID int UNSIGNED auto_increment,
        pID tinyint UNSIGNED not null,
        vID tinyint UNSIGNED not null,
        brojTrkaca tinyint UNSIGNED not null,
        datumIVrijeme datetime not null,
        brojLapova tinyint not null,
        primary key (tID),
        FOREIGN KEY (pID) REFERENCES Putanje(pID),
        FOREIGN KEY (vID) REFERENCES Vozila(vID)
    );

    create table VezaKorisnikTrka(
        kID mediumint UNSIGNED not null,
        tID int UNSIGNED not null,
        FOREIGN KEY (kID) REFERENCES Korisnici(kID),
        FOREIGN KEY (tID) REFERENCES Trke(tID),
        primary key (kID, tID)
    );
    
    create table Cijene(
        pID tinyint UNSIGNED not null,
        vID tinyint UNSIGNED not null,
        cijena float(8) not null,
        FOREIGN KEY (pID) REFERENCES Putanje(pID),
        FOREIGN KEY (vID) REFERENCES Vozila(vID),
        primary key (pID, vID)
    )";

    if(!mysqli_multi_query($dbLink, $query))
            die(mysqli_error($dbLink));
        
    mysqli_close($dbLink)
?>