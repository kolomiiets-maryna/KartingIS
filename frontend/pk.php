<!DOCTYPE html>
<html>

<head>
    <title>Prijava korisnika</title>
    <link rel="stylesheet" href="../css/general.css">
</head>

<body>
    <div class="align_area">
        <div id="s1">
            <img src="../images/flags/flag1.jpg" alt="zastava">
        </div>
        <div id="glavni" class="needed_margin">
            <h1>Prijava korisnika</h1>
            <form id="login-form" method="POST" action="../backend/user_registration_handler.php">
                <div class="center form-row half_width">
                    <input type="text" name="username" placeholder="Korisničko ime" required>
                </div>
                <div class="center form-row half_width">
                    <input type="password" name="password" placeholder="Lozinka" required>
                </div>
                <div class="center form-row half_width">
                    <input type="tel" name="phone" placeholder="Broj telefona" required>
                </div>
                <div class="center form-row half_width">
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="center form-row half_width">
                    <input type="date" name="birthday" placeholder="Datum rođenja" required>
                </div>
                <div class="center form-row half_width">
                    <button type="submit">Prijava</button>
                </div>
            </form>
        </div>
        <div id="s2">
            <img src="../images/flags/flag1.jpg" alt="zastava">
        </div>
    </div>
</body>

</html>