<?php

function getResultats($tri, $ordre) {
    // 1. Connexion à la base de données
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=jo;charset=utf8', 'root', 'Ibrakid213%');
    } catch (PDOException $e) {
        die('Erreur de connexion : ' . $e->getMessage());
    }

    // 2. Liste des colonnes autorisées (Sécurité)
    $colonnesAutorisees = ['id', 'nom', 'pays', 'temps', 'course'];

    // 3. Vérification du tri (Si le mot n'est pas dans la liste, on remet 'nom')
    if (!in_array($tri, $colonnesAutorisees)) {
        $tri = 'nom';
    }

    // 4. Vérification de l'ordre (Si ce n'est pas DESC, on met ASC)
    if ($ordre !== 'DESC') {
        $ordre = 'ASC';
    }

    // 5. Préparation et exécution de la requête
    $sql = "SELECT * FROM joooo.`100` ORDER BY $tri $ordre";
    
    $query = $pdo->query($sql);
    
    // 6. Envoi des résultats
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
?>
