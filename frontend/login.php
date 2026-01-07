<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-weight: bold;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height:  100vh;
            text-align: center;
        }

        @font-face { 
            font-family: 'Sakana'; 
            src: url('../fonts/Sakana.ttf') format('truetype'); 
            font-weight: normal; 
            font-style: normal; 
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 80%;
            max-width: 400px;
        }

        h1 {
            color:#1b2957;;
            margin-bottom: 20px;
            font-family: 'Sakana';
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color:  #1b2957;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
        }

        button:hover {
            background-color:   #465999;
        }
    </style>
</head>

<?php
    session_start();
?>

<body>
    
    <div class="container">
        <h1>Prijava</h1>
        <form id="login-form" method="POST" action="http://localhost/KartingIS/backend/login_handler.php">
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
                <a href="http://localhost/KartingIS/frontend/pk.php">Nemate nalog?</a>
            </div>
        </form>
    </div>
</body>
</html>