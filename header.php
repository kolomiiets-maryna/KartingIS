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

        <a class="logo" href="../frontend/main.php">
            KARTING CENTAR
        </a>
        
        <?php if(!isset($_SESSION["kID"])) : ?>
            <div class="login-button">
                <a href="../frontend/login.php" class="btn">
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
                <a href="../frontend/kp.php" class="btn">
                    Vas Nalog
                </a>
            </div>
        <?php endif; ?>

    </header>

    <nav class="nav-bar">
        <a class="options" href="../frontend/pp.php">PUTANJA</a>
        <a class="options" href="../frontend/pv.php">VOZILA</a>
        <a class="options" href="../frontend/cjenovnik.php">CJENOVNIK</a>
        <div class="dropdown">
            <a href="#" class="dropbtn">TRKE</a>
            <div class="dropdown-content">
                <?php if(isset($_SESSION["kID"])) : ?>
                    <a class="dropdown-el" href="../frontend/pt.php">Prijava trke</a>
                <?php endif; ?>
                <a class="dropdown-el" href="../frontend/trke.php">Postojeće trke</a>
            </div>
        </div>
    </nav>
</div>
</body>
</html>