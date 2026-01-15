<!DOCTYPE html>
<html>
<head>
    <title>Moji podaci</title>
    <link rel="stylesheet" href="../css/general.css">
</head>

<?php
    require_once("header.php");
    if(empty($_SESSION["kID"])){
        header("location: ../frontend/main.php");
        exit();
    }

    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje sa bazom: " . mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));

    $query = "select * from Korisnici where kID = " . $_SESSION['kID'] . ";";
    
    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $result = mysqli_fetch_all($temp);
?>

<body>
    <div class="align_area">
        <div id="s1">
            <img src="../images/flags/flag1.jpg" alt="zastava">
        </div>
        <div id="glavni">
            <h1>Moji podaci</h1>
            <form id="lični-podaci">
                <p>Korisničko ime: <?php echo $result[0][1]; ?><span id="username"> </span></p>
                <p>Telefon: <?php echo $result[0][4]; ?><span id="phone"> </span></p>
                <p>Email: <?php echo $result[0][5]; ?><span id="email"> </span></p>
                <p>Rođendan: <?php echo $result[0][3]; ?><span id="birthday"> </span></p>
                <p>Broj trka: <?php echo $result[0][6]; ?><span id="BrojTrka"> </span></p>
                <p>Poslednja trka: <?php echo $result[0][8]; ?><span id="LastPresent"> </span></p>
                <p>Lični rekord: <?php echo $result[0][7]; ?><span id="BestLapTime"> </span></p>
            </form>
        </div>
        <div id="s2">
            <img src="../images/flags/flag1.jpg" alt="zastava">
        </div>
    </div>
</body>
</html>