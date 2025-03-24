<?php
require "db-connection.php";

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
        header("Refresh:3; url = select.php");
    } else {
        echo "Er is een fout opgetreden!";
        die();
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
    <h1>Product editen</h1>
    <form method="POST">
        <input type="text" name="product_naam" placeholders="Product Naam" required>
        <input type="text" name="prijs_per_stuk" placeholders="Prijs Per Stuk" required>
        <input type="text" name="omschrijving" placeholders="Omschrijving" required>
        <input type="submit" name="knop" value="Submit">
    </form>
</body>
</html>