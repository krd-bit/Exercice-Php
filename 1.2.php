<?php
/**
 * Affiche les nombres de 1 à 100 avec les règles de FooBar.
 */
function fooBar() {
    
    for ($i = 1; $i <= 100; $i++) {
        
       
        if ($i % 15 == 0) {
            echo "FooBar";
        }         elseif ($i % 3 == 0) {
            echo "Foo";
        } 
        // Sinon, on vérifie si c'est un multiple de 5
        elseif ($i % 5 == 0) {
            echo "Bar";
        } 
    
        else {
            echo $i;
        }
        
 .
        echo "<br>";
    }
}

?>