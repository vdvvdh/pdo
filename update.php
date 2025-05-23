<?php
require "db-connection.php";

$db = new DB();
$pdo = $db->pdo;

if (isset($_POST['knop'])) {
    $product_naam = $_POST['product_naam'];
    $prijs_per_stuk = $_POST['prijs_per_stuk'];
    $omschrijving = $_POST['omschrijving'];
    $product_code = $_POST['product_code'];

    $sql = "UPDATE Producten SET product_naam= :product_naam, prijs_per_stuk= :prijs_per_stuk, omschrijving= :omschrijving WHERE product_code= :product_code";
    $result = $pdo->prepare($sql);
    $placeholders = [
        "product_naam" => $product_naam,
        "prijs_per_stuk" => $prijs_per_stuk,
        "omschrijving" => $omschrijving,
        "product_code" => $product_code
    ];
    $result->execute($placeholders);

    if ($result) {
        echo "Product aangepast!";
        header("Refresh:3; url=select.php");
        exit;
    } else {
        echo "Er is een fout opgetreden!";
        die();
    }
}

// Haal het product op via GET om formulier te vullen
if (isset($_GET['product_code'])) {
    $stmt = $pdo->prepare("SELECT * FROM Producten WHERE product_code = :product_code");
    $stmt->execute(['product_code' => $_GET['product_code']]);
    $product = $stmt->fetch();
} else {
    // Geen product_code doorgegeven, redirect of foutmelding tonen
    header("Location: select.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <title>Product editen</title>
</head>
<body>
    <h1>Product editen</h1>
    <form method="POST">
        <input type="text" name="product_naam" placeholder="Product Naam" required value="<?= htmlspecialchars($product['product_naam']) ?>">
        <input type="text" name="prijs_per_stuk" placeholder="Prijs Per Stuk" required value="<?= htmlspecialchars($product['prijs_per_stuk']) ?>">
        <input type="text" name="omschrijving" placeholder="Omschrijving" required value="<?= htmlspecialchars($product['omschrijving']) ?>">
        <input type="hidden" name="product_code" value="<?= htmlspecialchars($product['product_code']) ?>">
        <input type="submit" name="knop" value="Submit">
    </form>
</body>
</html>
