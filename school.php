<?php
/**
 * Retourne le niveau scolaire en fonction de l'âge.
 *
 * @param int 
 * @return string 
 */
function school($age) {
    

    if (!is_numeric($age) || $age < 0) {
        return "Âge non valide";
    }


    if ($age < 3) {
        return "creche";
    } 
   
    elseif ($age < 6) {
        return "maternelle";
    } 
   
    elseif ($age < 11) {
        return "primaire";
    } 
    // etc.
    elseif ($age < 16) {
        return "college";
    } 
    elseif ($age < 18) {
        return "lycée";
    } 

    else {
        return ""; 
    }
}

?>