<?php
require_once 'database.php';
$mesDonnees = getResultats(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Classement du 100m</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de l'athlète</th>
                <th>Pays</th>
                <th>Temps (sec)</th>
                <th>Course</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mesDonnees as $ligne): ?>
                <tr>
                    <td><?= $ligne['id']; ?></td>
                    <td><strong><?= $ligne['nom']; ?></strong></td>
                    <td><?= $ligne['pays']; ?></td>
                    <td><?= $ligne['temps']; ?></td>
                    <td><?= $ligne['course']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</body>
</html>