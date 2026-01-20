<!DOCTYPE html>
<html>
<head>
    <title>Postojeće trke</title>
    <link rel="stylesheet" href="../css/general.css" type="text/css">
</head>

<?php
    require_once("header.php");
    $host = $_SERVER['HTTP_HOST'];

    if(empty($_SESSION["kID"])){
        header("location: http://$host/KartingIS/frontend/main.php");
        exit();
    }

    include_once("../backend/connect_to_database.php");

    if(!empty($_POST)){
        $_SESSION['lastDate'] = $_POST['date'];
    }

    if(!empty($_SESSION['lastDate'])){

        $query = "SELECT * from Trke where DATE(datumIVrijeme) = '{$_SESSION['lastDate']}'
        order by datumIVrijeme ASC;";
        
        $temp = mysqli_query($dbLink, $query);
        if(!$temp)
            die("Neuspjesno nalazenje trke: " . mysqli_error($dbLink));
        $trke = mysqli_fetch_all($temp);

        $query = "SELECT naziv from Putanje;";
        
        $temp = mysqli_query($dbLink, $query);
        if(!$temp)
            die("Neuspjesno nalazenje putanje: " . mysqli_error($dbLink));
        $putanje = mysqli_fetch_all($temp);

        $query = "SELECT naziv from Vozila;";
        
        $temp = mysqli_query($dbLink, $query);
        if(!$temp)
            die("Neuspjesno nalazenje vozila: " . mysqli_error($dbLink));
        $vozila = mysqli_fetch_all($temp);

        $query = "SELECT count(kt.kID) FROM Trke
        left join VezaKorisnikTrka as kt on kt.tID = Trke.tID 
        where date(Trke.datumIVrijeme) = '{$_SESSION['lastDate']}' 
        group by Trke.tID
        order by Trke.datumIVrijeme ASC;";

        $temp = mysqli_query($dbLink, $query);
        if(!$temp)
            die(mysqli_error($dbLink));
        $racerNums = mysqli_fetch_all($temp);

        $query = "SELECT kID FROM Trke left join (
        select kt.tID, kID from VezaKorisnikTrka as kt 
        where kID = {$_SESSION["kID"]}) test on Trke.tID = test.tID
        where date(Trke.datumIVrijeme) = '{$_SESSION['lastDate']}'
        order by Trke.datumIVrijeme ASC;";

        $temp = mysqli_query($dbLink, $query);
        if(!$temp)
            die(mysqli_error($dbLink));
        $attending = mysqli_fetch_all($temp);
    }

    mysqli_close($dbLink);
?>

<body>
    <div id="s1">
        <img src="../images/flags/flag1.jpg" alt="zastava">
    </div>
    <div id="glavni" class="align_area">
        <h1>Postojeće trke</h1>
        <form method="POST" action="trke.php">
            <div class="form-row">
                Izaberite datum:
            </div>
            <div class="center form-row half_width">
                <input type="date" name="date" <?php if(!empty($_SESSION['lastDate'])) echo "value='{$_SESSION['lastDate']}'" ?>>
            </div>
            <div class="form-row">
                <button type="submit">PRETRAŽITE</button>
            </div>
        </form>
        <?php if(!empty($_SESSION['lastDate'])) : ?>
            <?php if(count($trke) > 0) : ?>
                <form method="POST" action="../backend/race_application_and_deletion_handler.php">
                    <table class="track_table">
                        <tr class="zero_margin">
                            <th class="track_table_cell">Putanja</th>
                            <th class="track_table_cell">Vozila</th>
                            <th class="track_table_cell">Vrijeme</th>
                            <th class="track_table_cell">Br. Mjesta</th>
                            <th class="track_table_cell">Br. Lapova</th>
                            <th class="track_table_cell">Prijavi/Odjavi se</th>
                            <?php if($_SESSION["admin"] == true) : ?>
                                <th class="track_table_cell">Izbrši</th>
                            <?php endif; ?>
                        </tr>
                        <tbody id="ZakazaneTrke">
                            <?php for($i = 0; $i < count($trke); $i++) :?>
                                <tr <?php if($attending[$i][0] != null) :?>class="light_green"<?php endif;?>>
                                    <td class="track_table_cell"><?php echo $putanje[$trke[$i][1]][0]; ?></td>
                                    <td class="track_table_cell"><?php echo $vozila[$trke[$i][2]][0]; ?></td>
                                    <td class="track_table_cell"><?php echo substr($trke[$i][4], 11, 5); ?></td>
                                    <td class="track_table_cell"><?php echo $trke[$i][3] - $racerNums[$i][0]; ?></td>
                                    <td class="track_table_cell"><?php echo $trke[$i][5]; ?></td>
                                    <td class="track_table_cell"><input type="checkbox" name="assign[]" value="<?php echo $trke[$i][0]; ?>"></td>
                                    <?php if($_SESSION["admin"] == true) : ?>
                                        <td class="track_table_cell"><input type="checkbox" name="delete[]" value="<?php echo $trke[$i][0]; ?>"></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                        <div class="form-row">
                            <button type="submit">PRIJAVITE SE<?php if($_SESSION["admin"] == true) echo " / IZBRIŠITE TRKE"; ?></button>
                        </div>
                    </table>
                </form>
            <?php else : ?>
                <h3 class="reg_error_message">Nema zakazane trke datog datuma</h3>
            <?php endif; ?>
        <?php endif; ?>
    </div>
     <div id="s2">
        <img src="../images/flags/flag1.jpg" alt="zastava">
    </div>
</body>
</html>