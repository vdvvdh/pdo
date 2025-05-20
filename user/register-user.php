<?php

require "../db-connection.php";

$pdo = new DB();
$errors = [];
$success = "";

$naam = $email = $wachtwoord = $adres = $telefoon = "";

if (isset($_POST['knop'])) {
    
    $naam = htmlspecialchars(($_POST['naam']));
    $email = htmlspecialchars(($_POST['email']));
    $wachtwoord = htmlspecialchars(($_POST['wachtwoord']));
    $adres = htmlspecialchars(($_POST['adres']));
    $telefoon = htmlspecialchars(($_POST['telefoon']));

    
    if (empty($naam) || !preg_match('/^[a-zA-Z0-9]{3,}$/', $naam)) {
        $errors[] = "Gebruikersnaam is verplicht en moet minstens 3 tekens bevatten (alleen letters/cijfers).";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Ongeldig e-mailadres.";
    }

    if (empty($wachtwoord)) {
        $errors[] = "Wachtwoord is verplicht.";
    }

    if (empty($adres)) {
        $errors[] = "Adres is verplicht.";
    }

    if (empty($telefoon) || !preg_match('/^[0-9]+$/', $telefoon)) {
        $errors[] = "Telefoonnummer is verplicht en mag alleen cijfers bevatten.";
    }

    
    if (empty($errors)) {
        try {
            $pdo->aanmelden($naam, $email, $wachtwoord, $adres, $telefoon);
            $success = "Account succesvol aangemaakt!";
            
            $naam = $email = $wachtwoord = $adres = $telefoon = "";
        } catch (PDOException $e) {
            $errors[] = "Fout bij aanmelden: " . $e->getMessage();
        }
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
<style>
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    input{
        width: auto;
        padding: 10px;
        margin: 8px 0;
        border-radius: 5px;
    }

    button{
        width: auto;
        padding: 10px;
        background-color: red;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .error {
        color: red;
        margin-bottom: 10px;
    }

    .success {
        color: green;
        margin-bottom: 10px;
    }
</style>
<body>
    <form method="POST" action="">
        <?php
        if (!empty($errors)) {
            echo '<div class="error"><ul>';
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo '</ul></div>';
        }

        if ($success) {
            echo "<div class='success'>$success</div>";
        }
        ?>
        <input type="text" name="naam" placeholder="username" required><br>
        <input type="email" name="email" placeholder="email" required><br>
        <input type="password" name="wachtwoord" placeholder="password" required><br>
        <input type="text" name="adres" placeholder="adres" required><br>
        <input type="text" name="telefoon" placeholder="telefoon" required><br>
        <button type="submit" name="knop">Submit</button>
    </form>
</body>
</html>

