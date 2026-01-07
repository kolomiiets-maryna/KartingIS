<!DOCTYPE html>
<html>
<head>
    <title>Moji podaci</title>
    <link rel="stylesheet" href="http://localhost/KartingIS/css/kp.css">
</head>

<?php
    require_once("../header.php");
?>

<body>
    <div class="align_area">
        <div id="s1">
            <img src="http://localhost/KartingIS/images/flags/flag1.jpg" alt="zastava">
        </div>
        <div id="glavni">
            <h1>Moji podaci</h1>
            <form id="lični-podaci">
                <p>Ime i prezime: <span id="username"> </span></p>
                <p>Telefon: <span id="phone"> </span></p>
                <p>Email: <span id="email"> </span></p>
                <p>Godine: <span id="age"> </span></p>
                <p>Broj trka: <span id="BrojTrka"> </span></p>
                <p>Poslednja trka: <span id="LastPresent"> </span></p>
                <p>Lični rekord: <span id="BestLapTime"> </span></p>
            </form>
        </div>
        <div id="s2">
            <img src="http://localhost/KartingIS/images/flags/flag1.jpg" alt="zastava">
        </div>
    </div>
</body>
</html>