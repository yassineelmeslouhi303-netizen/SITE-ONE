<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "riade_el_hamde";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

echo "Connexion réussie !";
?>