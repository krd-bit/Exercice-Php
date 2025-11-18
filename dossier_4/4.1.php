<?php

$eleves = [
    ["nom" =>"Alice", "notes" => [15, 14, 16]],
    ["nom" => "Bob", "notes" => [12, 10, 11]],
    ["nom" => "Claire", "notes" => [18, 17, 15]],
];

foreach ($eleves as $eleve) {
    $somme = array_sum(array: $eleve['notes']);
    $nombre = count(value: $eleve['notes']);
    $moyenne = $somme / $nombre;

    echo $eleve['nom'] . " a une moyenne de " . $moyenne . "\n";

}
?>