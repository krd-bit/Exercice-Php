<?php

function getResultats($tri, $ordre) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=jo;charset=utf8', 'root', 'Ibrakid213%');
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $colonnesAutorisees = ['id', 'nom', 'pays', 'temps', 'course'];

    if (!in_array($tri, $colonnesAutorisees)) {
        $tri = 'nom';
    }

    if ($ordre !== 'DESC') {
        $ordre = 'ASC';
    }

    $sql = "SELECT * FROM joooo.`100` ORDER BY $tri $ordre";
    
    $query = $pdo->query($sql);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
?>