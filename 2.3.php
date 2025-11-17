<?php
/**
 * Vérifie si une chaîne de caractères (haystack) en contient une autre (needle).
 * On a le droit d'utiliser strlen(), count() et isset().
 *
 * @param string $haystack La chaîne principale (la "botte de foin").
 * @param string $needle La chaîne qu'on recherche (l'"aiguille").
 * @return bool true si on la trouve, false sinon.
 */
function my_str_contains($haystack, $needle) {
    
    // On récupère les longueurs des deux chaînes
    $longueurHaystack = strlen($haystack);
    $longueurNeedle = strlen($needle);

    // Cas spécial : si l'aiguille (needle) est vide, la fonction
    // PHP str_contains retourne 'true'. On fait pareil.
    if ($longueurNeedle == 0) {
        return true;
    }

    // Cas spécial 2 : si l'aiguille est plus longue que la botte de foin,
    // elle ne peut pas être dedans !
    if ($longueurNeedle > $longueurHaystack) {
        return false;
    }

    // --- La logique principale ---
    
    // Boucle 1 (Externe) : on parcourt la botte de foin.
    // On n'a pas besoin d'aller jusqu'au bout, on peut s'arrêter 
    // à $longueurHaystack - $longueurNeedle.
    for ($i = 0; $i <= $longueurHaystack - $longueurNeedle; $i++) {
        
        // À chaque position $i, on va supposer que c'est un match
        $match = true; 

        // Boucle 2 (Interne) : on parcourt l'aiguille
        for ($j = 0; $j < $longueurNeedle; $j++) {
            
            // On compare la lettre de l'aiguille ($needle[$j])
            // avec la lettre correspondante dans la botte de foin ($haystack[$i + $j])
            if ($haystack[$i + $j] != $needle[$j]) {
                
                // Si ça ne correspond pas, c'est raté !
                $match = false;
                
                // On peut arrêter la boucle interne, pas la peine de continuer
                break; 
            }
        }

        // Si, après la boucle interne, $match est TOUJOURS à true,
        // c'est qu'on a trouvé une correspondance parfaite !
        if ($match) {
            return true; // On a trouvé ! On arrête tout et on dit "vrai".
        }
        
        // Sinon, on continue la boucle externe pour tester la position $i suivante...
    }

    // Si on arrive ici, ça veut dire que la boucle externe est terminée
    // et qu'on n'a jamais rien trouvé.
    return false;
}

// --- Pour tester la fonction ---
// $phrase = "J'aime le PHP";
// $mot1 = "PHP";
// $mot2 = "Java";

// // var_dump est bien pour voir les "true" et "false"
// var_dump(my_str_contains($phrase, $mot1)); // Devrait afficher bool(true)
// echo "<br>";
// var_dump(my_str_contains($phrase, $mot2)); // Devrait afficher bool(false)
?>