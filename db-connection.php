<?php
$host = 'localhost:3306';
$db   = 'winkel2';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    echo "error:" . $e-> getMessage();
}
?>

