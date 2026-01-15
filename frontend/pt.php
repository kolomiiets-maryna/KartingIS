<!DOCTYPE html>
<html>

<head>
    <title>Prijava trke</title>
    <link rel="stylesheet" href="../css/general.css">
</head>

<?php
    require_once("header.php");
    
    if(empty($_SESSION["kID"])){
        header("location: http://localhost/KartingIS/frontend/main.php");
        exit();
    }

    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje: " . mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));

    $query = "select vID, naziv from Vozila";
    
    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $vozila = mysqli_fetch_all($temp);

    $query = "select pID, naziv from Putanje";
    
    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $putanje = mysqli_fetch_all($temp);

    mysqli_close($dbLink);
?>

<body>
    <div class="align_area">
        <div id="s1">
            <img src="../images/flags/flag1.jpg" alt="zastava">
        </div>
        <div id="glavni">
            <h1>Prijava trke</h1>
            <?php if(isset($_SESSION["RaceRegError"])) : ?>
                <h3 class="reg_error_message"><?php echo $_SESSION["RaceRegError"]; ?></h3>
            <?php unset($_SESSION["RaceRegError"]); 
            elseif(isset($_SESSION["RaceRegSuccess"])) : ?>
                <h3 class="reg_success_message"><?php echo $_SESSION["RaceRegSuccess"]; ?></h3>
            <?php unset($_SESSION["RaceRegSuccess"]); endif; ?>
    <form id="race-form" method="POST" action="../backend/race_registration_handler.php">
        <div class="form-row">
            <label for="broj_ucesnika">Broj učesnika:</label>
            <input type="number" name="broj_ucesnika" placeholder="Broj učesnika" required>
        </div>
        <div class="form-row">
            <label for="datum">Datum:</label>
            <input type="date" name="datum" placeholder="Datum" required>
        </div>
        <div class="form-row">
            <label for="vrijeme">Vrijeme:</label>
            <input type="time" name="vrijeme" placeholder="Vrijeme" required>
        </div>
        <div class="form-row">
            <label for="lapovi">Broj Lapova:</label>
            <input type="number" name="lapovi" placeholder="10" required>
        </div>
        <div class="form-row">
            <label for="vozila">Tip vozila:</label>
            <select name="vozila" id="vozila" required>
                <?php foreach($vozila as $vozilo) : ?>
                    <option value="<?php echo $vozilo[0]; ?>"><?php echo $vozilo[1]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-row">
            <label for="putanja">Tip putanje:</label>
            <select name="putanja" id="putanja" required>
                <?php foreach($putanje as $putanja) : ?>
                    <option value="<?php echo $putanja[0]; ?>"><?php echo $putanja[1]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-row">
            <button type="submit">PRIJAVI TRKU</button>
        </div>
    </form>
        </div>
        <div id="s2">
            <img src="../images/flags/flag1.jpg" alt="zastava">
        </div>
    </div>
</body>

</html>