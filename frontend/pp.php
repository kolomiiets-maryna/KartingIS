<!DOCTYPE html>
<html>

<head>
    <title>Putanje</title>
    <link rel="stylesheet" href="http://localhost/KartingIS/css/general.css">
</head>

<?php
    require_once("../header.php");

    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje sa bazom: " . mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));

    $query = "select naziv, duzina from Putanje";
    
    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $result = mysqli_fetch_all($temp);

    unset($temp);
    mysqli_close($dbLink);
?>

<body>
    <div class="align_area">
        <h1>PUTANJE</h1>
        <?php for($i = 0; $i < count($result); $i++) : ?>
            <div class="thingamajig<?php if($i == count($result)-1) echo ' zero_margin needed_margin';?>">
                <h2><?php echo $result[$i][0]?></h2>
                
                <img class="putanja" 
                src="http://localhost/KartingIS/images/tracks/<?php echo $result[$i][0]?>.jpg" 
                alt="<?php echo $result[$i][0]?>">

                <h3>Duzina: <?php echo $result[$i][1]; ?>m</h3>
            </div>
        <?php endfor;?>
        <div id="slika">
            <img  src="http://localhost/KartingIS/images/flags/flag2.jpg" alt="zastava">
        </div>
    </div>
</body>

</html>