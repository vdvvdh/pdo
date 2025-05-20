<?php

Class DB{
    public $pdo;

    public function __construct($db = "winkel2", $host="localhost", $user="root", $pass=""){
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            //set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: ". $e->getMessage();
        }
    }

    public function aanmelden($naam, $email, $password, $adres, $telefoon){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT into gebruikers (naam, email, wachtwoord, adres, telefoon) VALUES (:naam, :email, :wachtwoord, :adres, :telefoon)");
        $stmt->execute(["naam" => $naam, "email" => $email, "wachtwoord" => $hash, "adres" => $adres, "telefoon" => $telefoon]);
    }

}
?>

