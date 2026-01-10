<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<?php
    session_start();
?>

<body>
    
    <div class="container">
        <h1>Prijava</h1>
        <form id="login-form" method="POST" action="../backend/login_handler.php">
            <input type="text" name="username" placeholder="Korisničko ime" required>
            <input type="password" name="password" placeholder="Lozinka" required>
            <button type="submit">Prijava</button>

            <?php
            if(isset($_SESSION["badlogin"])){
                echo "<div style='color: red; margin-top: 10px;'>
                    Pogresno ime ili sifra!
                </div>";
                unset($_SESSION["badlogin"]);
            }
            ?>

            <div style="margin-top: 10px;">
                <a href="../frontend/pk.php">Nemate nalog?</a>
            </div>
        </form>
    </div>
</body>
</html>