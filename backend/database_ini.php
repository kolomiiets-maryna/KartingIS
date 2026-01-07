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
        kID int(7) AUTO_INCREMENT,
        korisnickoIme varchar(20) not null,
        sifra varchar(20) not null,
        godine int(3) not null,
        rodjendan date not null,
        tel varchar(12),
        eMail varchar(64) not null,
        brojTrka int(4),
        bestLapTime float(12),
        lastPresent date,
        admin boolean not null,
        primary key (kID)
    );

    create table if not exists Vozila(
        vID int(2) auto_increment,
        naziv varchar(15) not null,
        broj int(3) not null,
        brojDostupnih int(3) not null,
        primary key (vID)
    );

    create table if not exists Putanje(
        pID int(2) auto_increment,
        naziv varchar(20) not null,
        duzina int(5) not null,
        primary key (pID)
    );

    create table if not exists Trke(
        tID int(8) auto_increment,
        pID int(2) not null,
        tip int(2) not null,
        datumIVrijeme datetime not null,
        trajanje float(8) not null,
        brojLapova int(2) not null,
        primary key (tID),
        FOREIGN KEY (pID) REFERENCES Putanje(pID)
    );

    create table VezaKorisnikTrka(
        kID int(7) not null,
        tID int(8) not null,
        FOREIGN KEY (kID) REFERENCES Korisnici(kID),
        FOREIGN KEY (tID) REFERENCES Trke(tID),
        UNIQUE (kID, tID)
    );
    
    create table Cijene(
        pID int(2) not null,
        vID int(2) not null,
        cijena float(8) not null,
        FOREIGN KEY (pID) REFERENCES Putanje(pID),
        FOREIGN KEY (vID) REFERENCES Vozila(vID),
        UNIQUE (pID, vID)
    )";

    if(!mysqli_multi_query($dbLink, $query))
            die(mysqli_error($dbLink));
        
    mysqli_close($dbLink)
?>