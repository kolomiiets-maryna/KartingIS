<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karting Centar</title>
    <link type="text/css" rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<?php
    session_start();
    $_SESSION["lastPage"] = $_SERVER['REQUEST_URI'];
?>

<body>
    <div class="pozadina">
    <header class="topbar">

        <a class="logo" href="main.php">
            KARTING CENTAR
        </a>
        
        <?php if(!isset($_SESSION["kID"])) : ?>
            <div class="login-button">
                <a href="login.php" class="btn">
                    <i class="fas fa-sign-in-alt"></i> Prijava
                </a>
            </div>
        <?php  else :?>
            <div class="login-button">
                <a href="../backend/odjava.php" class="btn">
                    <i class="fas fa-sign-in-alt"></i> Odjava
                </a>
            </div>

            <div class="login-button">
                <a href="kp.php" class="btn">
                    Vas Nalog
                </a>
            </div>
        <?php endif; ?>

    </header>

    <nav class="nav-bar">
        <a class="options" href="pp.php">PUTANJA</a>
        <a class="options" href="pv.php">VOZILA</a>
        <a class="options" href="cjenovnik.php">CJENOVNIK</a>
        <?php if(isset($_SESSION["kID"])) : ?>
            <div class="options dropdown">
                <a href="#" class="dropbtn">TRKE</a>
                <div class="dropdown-content">
                    <a class="dropdown-el" href="pt.php">Prijava trke</a>
                    <a class="dropdown-el" href="trke.php">Postojeće trke</a>
                </div>
            </div>
            <?php if($_SESSION["admin"]) : ?>
                <div class="options dropdown">
                    <a href="#" class="dropbtn">ADMIN</a>
                    <div class="dropdown-content">
                        <a class="dropdown-el" href="user_manage.php">Korisnici</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </nav>
</div>
</body>
</html>