<?php
/**
 * Génère une "pyramide" de chiffres.
 *
 * @param int 
 * @return string 
 */
function doubleBoucle($nombre) {
    
   
    $resultat = "";
    
    
    for ($i = 1; $i <= $nombre; $i++) {
        
     
        for ($j = 1; $j <= $i; $j++) {
            
      
            $resultat .= $i;
        }
        
        
        $resultat .= "\n";
    }
    

    return $resultat;
}

?>