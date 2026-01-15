<!DOCTYPE html>
<html>
<head>
    <title>Postojeće trke</title>
    <link rel="stylesheet" href="../css/general.css" type="text/css">
</head>

<?php
    require_once("header.php");

    if(empty($_SESSION["kID"]) && !$_SESSION['admin']){
        header("location: http://localhost/KartingIS/frontend/main.php");
        exit();
    }

    if(!empty($_POST)){
        $_SESSION['lastUsername'] = $_POST['username'];
    }

    if(!empty($_SESSION['lastUsername'])){
        $dbLink = mysqli_connect("localhost","root","");
        if(!$dbLink)
            die("Neuspjesno povezivanje: " . mysqli_error($dbLink));

        mysqli_select_db($dbLink, "KartingIS") or die(mysqli_error($dbLink));

        $query = "SELECT kID, korisnickoIme, rodjendan, tel, eMail, admin from Korisnici 
        where instr(korisnickoIme, '{$_SESSION['lastUsername']}')
        and kID != {$_SESSION['kID']}
        order by kID ASC";
        
        $temp = mysqli_query($dbLink, $query);
        if(!$temp)
            die("Neuspjesno nalazenje trke: " . mysqli_error($dbLink));
        $users = mysqli_fetch_all($temp);

        mysqli_close($dbLink);
    }
?>

<body>
    <div id="s1">
        <img src="../images/flags/flag1.jpg" alt="zastava">
    </div>
    <div id="glavni" class="align_area">
        <h1>Korisnici</h1>
        <form method="POST" action="user_manage.php">
            <div class="center form-row _75_percent_width">
                <label for="username">Korisničko ime:</label>
                <input type="text" placeholder="Michael" name="username" <?php if(!empty($_SESSION['lastUsername'])) echo "value='{$_SESSION['lastUsername']}'";?> />
            </div>
            <div class="form-row">
                <button type="submit">PRETRAŽITE</button>
            </div>
        </form>
        <?php if(!empty($_SESSION['lastUsername'])) : ?>
            <?php if(count($users) > 0) : ?>
                <form method="POST" action="../backend/user_manage_handler.php">
                    <table class="track_table">
                        <tr class="zero_margin">
                            <th class="track_table_cell">Ime</th>
                            <th class="track_table_cell">Rodjendan</th>
                            <th class="track_table_cell">Telefon</th>
                            <th class="track_table_cell">E-mail</th>
                            <th class="track_table_cell">Admin</th>
                            <th class="track_table_cell">Izbrši</th>
                        </tr>
                        <tbody id="ZakazaneTrke">
                            <?php for($i = 0; $i < count($users); $i++) :?>
                                <tr>
                                    <td class="track_table_cell"><?php echo $users[$i][1]; ?></td>
                                    <td class="track_table_cell"><?php echo $users[$i][2]; ?></td>
                                    <td class="track_table_cell"><?php echo $users[$i][3]; ?></td>
                                    <td class="track_table_cell"><?php echo $users[$i][4]; ?></td>
                                    <td class="track_table_cell <?php if($users[$i][5]) : ?>light_green<?php endif; ?>"><input type="checkbox"  name="assign[]" value="<?php echo $users[$i][0]; ?>"></td>
                                    <td class="track_table_cell"><input type="checkbox" name="delete[]" value="<?php echo $users[$i][0]; ?>"></td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                        <div class="form-row">
                            <button type="submit">IZVRŠITE PROMJENU</button>
                        </div>
                    </table>
                </form>
            <?php else : ?>
                <h3 class="reg_error_message">Nema korisnika sa tim imenom</h3>
            <?php endif; ?>
        <?php endif; ?>
    </div>
     <div id="s2">
        <img src="../images/flags/flag1.jpg" alt="zastava">
    </div>
</body>
</html>