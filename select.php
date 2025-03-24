<?php
require "db-connection.php";

$producten = $pdo->query("SELECT * FROM Producten");

$result = $producten->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <h1>Overzicht Producten</h1>
    <table class="table table-dark">
        <tr>
            <th>Product Code</th>
            <th>Product Naam</th>
            <th>Prijs per stuk</th>
            <th>Omschrijving</th>
            <th>Action</th>
        </tr>

        <?php
    foreach($result as $producten) {
        echo "<tr>";
            echo "<td>". $producten['product_code']. "</td>";
            echo "<td>". $producten['product_naam']. "</td>";
            echo "<td>". $producten['prijs_per_stuk']. "</td>";
            echo "<td>". $producten['omschrijving']. "</td>";
            echo "<td> <a href='update.php?product_code=". $producten['product_code']."'>Edit</a> </td>";
        echo "</tr>";
    }

    ?>

    </table>
</body>
</html>

