<?php

// 1. Lire le fichier
$lines = file('https://blog-investissement-immobilier.lybox.fr/table.txt', FILE_IGNORE_NEW_LINES);

$erreurs = [];

// 2. Parcourir toutes les lignes
for ($i = 0; $i < count($lines); $i++) {
    
    // --- DÉBUT DU BLOC SÉCURISÉ ---
    
    // 1. On nettoie les espaces au début et à la fin de la ligne brute
    $ligne_propre = trim($lines[$i]);

    // Sécurité : on saute si la ligne est devenue vide (ligne blanche)
    if ($ligne_propre === '') {
        continue; 
    }

    // 2. On découpe. PREG_SPLIT_NO_EMPTY empêche de créer des cases vides si double espace
    $valeurs = preg_split('/\s+/', $ligne_propre, -1, PREG_SPLIT_NO_EMPTY);

    // Sécurité supplémentaire : on vérifie qu'on a bien 10 chiffres sur la ligne
    // Si la ligne est incomplète ou corrompue, on l'ignore pour ne pas faire planter le script
    if (count($valeurs) < 10) {
        continue; 
    }
    
    // --- FIN DU BLOC SÉCURISÉ ---


    // La table correspond au numéro de ligne + 1 (L'index 0 du tableau lines = Table de 1)
    $table = $i + 1;

    // On vérifie les colonnes de 1 à 10 (les multiplicateurs)
    for ($j = 1; $j <= 10; $j++) {
        
        // ATTENTION : $valeurs est indexé à 0.
        // Donc le multiplicateur 1 ($j=1) se trouve à l'index 0 ($valeurs[0]).
        $resultat_fichier = (int)$valeurs[$j - 1]; 
        
        $resultat_correct = $table * $j;

        if ($resultat_fichier !== $resultat_correct) {
            // Format "Colonne x Ligne" (ex: 4x5 pour l'erreur à la table de 5, 4ème position)
            $erreurs[] = "$j" . "x" . "$table";
        }
    }
}

// Affichage du résultat final
echo "Les erreurs sont : " . implode(', ', $erreurs);

?>