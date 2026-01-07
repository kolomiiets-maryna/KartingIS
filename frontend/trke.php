<!DOCTYPE html>
<html>
<head>
    <title>Postojeće trke</title>
    <link rel="stylesheet" href="http://localhost/KartingIS/css/general.css" type="text/css">
</head>

<?php
    require_once("../header.php");
?>

<body>
    <div id="s1">
        <img src="http://localhost/KartingIS/images/flags/flag1.jpg" alt="zastava">
    </div>
    <div id="glavni">
        <h1>Postojeće trke</h1>
        Izaberite datum: <input type="date" id="DatumTrke">
        <table>
            <tr>
                <th>Putanja</th>
                <th>Vrijeme</th>
            </tr>
            <tbody id="ZakazaneTrke"></tbody>
        </table>
    </div>
     <div id="s2">
        <img src="http://localhost/KartingIS/images/flags/flag1.jpg" alt="zastava">
    </div>
</body>
</html>