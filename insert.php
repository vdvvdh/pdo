<?php
require "db-connection.php";

if (isset($_POST['knop'])) {
    $product_naam = $_POST['product_naam'];
    $prijs_per_stuk = $_POST['prijs_per_stuk'];
    $omschrijving = $_POST['omschrijving'];

    $sql = "INSERT into Producten (product_naam, prijs_per_stuk, omschrijving) values (:product_naam, :prijs_per_stuk, :omschrijving)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        "product_naam" => $product_naam,
        "prijs_per_stuk" => $prijs_per_stuk,
        "omschrijving" => $omschrijving
    ]);

    echo "product gevoegd!";
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product toevoegen</title>
</head>
<body>
    <form method="POST">
        product naam: <input type="text" name="product_naam" required><br>
        prijs per stuk: <input type="text" name="prijs_per_stuk" required><br>
        omschrijving: <input type="text" name="omschrijving" required><br>
        <button type="submit" name="knop">Submit</button>
    </form>
</body>
</html>
