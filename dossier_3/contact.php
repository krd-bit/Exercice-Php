
<?php

$fichier = 'contact.txt';
$contacts_a_ajouter = ["Alice Dupont", "John Doe", "Jean Martin"];

$contenu_actuel = file_get_contents($fichier);
$texte_a_ajouter = "";

foreach ($contacts_a_ajouter as $contact) {
    if (strpos($contenu_actuel, $contact) === false) {
        $texte_a_ajouter .= "\n" . $contact;
    }
}

if (!empty($texte_a_ajouter)) {
    file_put_contents($fichier, $texte_a_ajouter, FILE_APPEND);
}

?>
```