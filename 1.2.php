<?php
/**
 * Affiche les nombres de 1 à 100 avec les règles de FooBar.
 * Cette fonction affiche le résultat directement (elle fait des 'echo').
 */
function fooBar(): void{
    
    // On fait une boucle qui va de 1 jusqu'à 100
    for ($i = 1; $i <= 100; $i++) {
        
        // On teste le cas le plus précis (multiple de 15) EN PREMIER
        if ($i % 15 == 0) {
            echo "FooBar";
        } 
        // Sinon, on vérifie si c'est un multiple de 3
        elseif ($i % 3 == 0) {
            echo "Foo";
        } 
        // Sinon, on vérifie si c'est un multiple de 5
        elseif ($i % 5 == 0) {
            echo "Bar";
        } 
        // Si ce n'est rien de tout ça, on affiche le nombre
        else {
            echo $i;
        }
        
        // On ajoute un saut de ligne en HTML
        echo "<br>";
    }
}

// ==========================================
// ZONE DE TEST pour foobar.php
// ==========================================
echo "<h1>Test de la fonction FooBar</h1>";

// On appelle la fonction pour qu'elle s'exécute et affiche le résultat
fooBar();

?>