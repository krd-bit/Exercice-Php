<?php
/**
 * Calcule la moyenne d'un tableau de nombres.
 *
 * @param array 
 * @return float La moyenne calculée.
 */
function calcMoy($tableau) {

    // On compte le nombre d'éléments
    $nombreElements = count($tableau);

    // Si le tableau est vide, on retourne 0 pour éviter une erreur
    if ($nombreElements == 0) {
        return 0;
    }

    // On initialise la somme à 0
    $somme = 0;

    // On parcourt chaque nombre pour les additionner
    foreach ($tableau as $nombre) {
        $somme += $nombre;
    }

    // On calcule la moyenne
    $moyenne = $somme / $nombreElements;

    // On retourne le résultat
    return $moyenne;
}

?>