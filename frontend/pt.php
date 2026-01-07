<!DOCTYPE html>
<html>

<head>
    <title>Prijava trke</title>
    <link rel="stylesheet" href="http://localhost/KartingIS/css/general.css">
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
            <h1>Prijava trke</h1>
    <form id="race-form">
        <div class="form-row">
            <label for="broj_ucesnika">Broj učesnika:</label>
            <input type="number" id="broj_ucesnika" placeholder="Broj učesnika" required>
        </div>
        <div class="form-row">
            <label for="imena_ucesnika">Imena učesnika:</label>
            <input type="text" id="imena_ucesnika" placeholder="Imena učesnika" required>
        </div>
        <div class="form-row">
            <label for="datum">Datum:</label>
            <input type="date" id="datum" placeholder="Datum" required>
        </div>
        <div class="form-row">
            <label for="vrijeme">Vrijeme:</label>
            <input type="time" id="vrijeme" placeholder="Vrijeme" required>
        </div>
        <div class="form-row">
            <label for="vozila">Tip vozila:</label>
            <select name="vozila" id="vozila" required>
                <option value="1">LR5</option>
                <option value="2">RT8</option>
                <option value="3">2Drive</option>
            </select>
        </div>
        <div class="form-row">
            <label for="putanja">Tip putanje:</label>
            <select name="putanja" id="putanja" required>
                <option value="1">Putanja 1</option>
                <option value="2">Putanja 2</option>
                <option value="3">Putanja 3</option>
            </select>
        </div>
        <div class="form-row">
            <button type="submit">PRIJAVI TRKU</button>
        </div>
    </form>
        </div>
        <div id="s2">
            <img src="http://localhost/KartingIS/images/flags/flag1.jpg" alt="zastava">
        </div>
    </div>
</body>

</html>