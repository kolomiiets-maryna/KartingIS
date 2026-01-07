<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karting Centar</title>
    <link type="text/css" rel="stylesheet" href="http://localhost/KartingIS/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<?php
    session_start();
    $_SESSION["lastPage"] = $_SERVER['REQUEST_URI'];
?>

<body>
    <div class="pozadina">
    <header class="topbar">

        <a class="logo" href="http://localhost/KartingIS/frontend/main.php">
            KARTING CENTAR
        </a>
        
        <?php if(!isset($_SESSION["kID"])) : ?>
            <div class="login-button">
                <a href="http://localhost/KartingIS/frontend/login.php" class="btn">
                    <i class="fas fa-sign-in-alt"></i> Prijava
                </a>
            </div>
        <?php  else :?>
            <div class="login-button">
                <a href="http://localhost/KartingIS/backend/odjava.php" class="btn">
                    <i class="fas fa-sign-in-alt"></i> Odjava
                </a>
            </div>

            <div class="login-button">
                <a href="http://localhost/KartingIS/frontend/kp.php" class="btn">
                    Vas Nalog
                </a>
            </div>
        <?php endif; ?>

    </header>

    <nav class="nav-bar">
        <a class="options" href="http://localhost/KartingIS/frontend/pp.php">PUTANJA</a>
        <a class="options" href="http://localhost/KartingIS/frontend/pv.php">VOZILA</a>
        <a class="options" href="http://localhost/KartingIS/frontend/cjenovnik.php">CJENOVNIK</a>
        <div class="dropdown">
            <a href="#" class="dropbtn">TRKE</a>
            <div class="dropdown-content">
                <a class="dropdown-el" href="http://localhost/KartingIS/frontend/pt.php">Prijava trke</a>
                <a class="dropdown-el" href="http://localhost/KartingIS/frontend/trke.php">Postojeće trke</a>
            </div>
        </div>
    </nav>
</div>
</body>
</html>