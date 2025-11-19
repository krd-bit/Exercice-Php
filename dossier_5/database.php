<?php

try {
    $mysqlClient = new PDO('mysql:host=localhost;dbname=jo;charset=utf8', 'root', 'Ibrakid213%');
} catch (PDOException $e) {
    die($e->getMessage());
}

// Requetes
$query = $mysqlClient->prepare("SELECT * FROM joooo.`100`");
$query->execute();

$data = $query->fetchAll();
var_dump($data);

// Fermeture de la connexion
$mysqlClient = null;
$dbh = null;

?>