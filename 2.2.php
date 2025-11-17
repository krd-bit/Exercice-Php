<?php
/**
 * Inversez chaîne de caractères
 * 
 *  @param string
 * @return string
 */
function my_strrev($chaine) {

    $chaineInversee = "";

    $longueur = strlen($chaine);

    for ($i = $longueur -1; $i >= 0; $i--){

        $lettre = $chaine[$i];

        $chaineInversee .= $lettre;
    }

    return $chaineInversee;

}

?>