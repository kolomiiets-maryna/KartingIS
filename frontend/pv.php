<!DOCTYPE html>
<html>

<head>
    <title>Vozila</title>
    <link rel="stylesheet" href="../css/general.css">
</head>

<?php
    require_once("header.php");

    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje sa bazom: " . mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));

    $query = "select naziv, broj, brojDostupnih from Vozila";
    
    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $result = mysqli_fetch_all($temp);

    mysqli_close($dbLink);

    $_admin = False;
    if(isset($_SESSION["admin"]))
        $_admin = $_SESSION["admin"];
?>

<body>
    <div class="align_area">
        <h1>VOZILA</h1>
        <?php for($i = 0; $i < count($result); $i++) : ?>
            <div class="thingamajig<?php if($i == count($result)-1) echo ' zero_margin needed_margin';?>">
                <h2><?php echo $result[$i][0]?></h2>

                <img class="vozilo" 
                src="../images/karts/<?php echo $result[$i][0]?>.jpg" 
                alt="<?php echo $result[$i][0]?>">
                
                <?php if($_admin) :?>
                    <h3>Ukupno: <?php echo $result[$i][1]?></h3>
                <?php endif; ?>
                <h3>Dostupno: <?php echo $result[$i][2]?></h3>
            </div>
        <?php endfor;?>
        
        <div id="slika">
            <img  src="../images/flags/flag2.jpg" alt="zastava">
        </div>
    </div>
</body>
</html>