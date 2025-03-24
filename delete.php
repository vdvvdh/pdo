<?php
require "db-connection.php";

if ($_GET['product_code']) {
    $sql = "DELETE FROM Producten WHERE product_code=:product_code";
    $result = $pdo-> prepare($sql);
    $placeholders = [
        "product_code" => $_GET['product_code']
    ];
    $result->execute($placeholders);
    if ($result) {
        echo "Product is verwijderd!";
        header("Refresh:3; url = select.php");
    } else {
        echo "Product kon niet verwijderd worden!";
        header("Refresh:3; url = select.php");
        die();
    }
} else {
    header("Location: select.php");
    die();
}
?>