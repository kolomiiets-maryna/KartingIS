<!DOCTYPE html>
<html>

<head>
    <title>Cjenovnik</title>
    <link rel="stylesheet" href="../css/general.css">
</head>

<?php
    require_once("header.php");

    $dbLink = mysqli_connect("localhost","root","");
    if(!$dbLink)
        die("Neuspjesno povezivanje sa bazom: " . mysqli_error($dbLink));

    mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));

    $query = "
    select cijena from Cijene
    order by pID, vID ASC";
    
    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $cijene = mysqli_fetch_all($temp);

    $query = "select naziv from Vozila";
    
    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $vozila = mysqli_fetch_all($temp);

    $query = "select naziv from Putanje";
    
    $temp = mysqli_query($dbLink, $query);
    if(!$temp)
        die(mysqli_error($dbLink));
    $putanje = mysqli_fetch_all($temp);

    mysqli_close($dbLink);
?>

<body>
    <div class="align_area">
        <h1>CJENOVNIK</h1>
        <h4>( Cijena jednog lap-a )</h4>
        <?php for($i = 0; $i < count($putanje); $i++) : ?>
            <div class="thingamajig<?php if($i == count($putanje)-1) echo " zero_margin needed_margin";?>">
                <h2><?php echo $putanje[$i][0]; ?></h2>
                <table class="round_table">
                    <tr>
                        <th>Vozilo</th>
                        <th>Cijena</th>
                    </tr>
                    <?php for($j = 0; $j < count($vozila); $j++) : ?>
                        <tr>
                            <td><?php echo $vozila[$j][0]; ?></td>
                            <td><?php echo $cijene[$i * count($vozila) + $j][0]; ?>€</td>
                        </tr>
                    <?php endfor;?>
                </table>
            </div >
        <?php endfor; ?>
    </div>
    <div id="slika">
        <img src="../images/flags/flag2.jpg" alt="zastava">
    </div>
</body>
</html>