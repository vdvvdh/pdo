<?php

require "../db-connection.php";


if (isset($_POST['knop'])) {
    try {
        $pdo->aanmelden($_POST['naam'], $_POST['email'], $_POST['wachtwoord'], $_POST['adres'], $_POST['telefoon']);
        echo "account aangemaakt";
    } catch (PDOException $e) {
        echo $e;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="#">
        <input type="text" name="naam" placeholder="username" required><br>
        <input type="email" name="email" placeholder="email" required><br>
        <input type="password" name="wachtwoord" placeholder="password" required><br>
        <input type="text" name="adres" placeholder="adres" required><br>
        <input type="text" name="telefoon" placeholder="telefoon" required><br>
        <button type="submit" name="knop">Submit</button>
    </form>
</body>
</html>