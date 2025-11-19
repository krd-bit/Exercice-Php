<?php
require_once 'database1.php';

$sort = 'nom';
$order = 'ASC';

if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}

if (isset($_GET['order'])) {
    $order = $_GET['order'];
}

$mesDonnees = getResultats($sort, $order);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TP JO</title>
</head>
<body>

<h1>Classement JO</h1>

<table>
    <thead>
        <tr>
            <th>
                Nom
                <a href="?sort=nom&order=ASC" style="<?= ($sort == 'nom' && $order == 'ASC') ? 'color:red' : '' ?>">↑</a>
                <a href="?sort=nom&order=DESC" style="<?= ($sort == 'nom' && $order == 'DESC') ? 'color:red' : '' ?>">↓</a>
            </th>
            <th>
                Pays
                <a href="?sort=pays&order=ASC" style="<?= ($sort == 'pays' && $order == 'ASC') ? 'color:red' : '' ?>">↑</a>
                <a href="?sort=pays&order=DESC" style="<?= ($sort == 'pays' && $order == 'DESC') ? 'color:red' : '' ?>">↓</a>
            </th>
            <th>
                Course
                <a href="?sort=course&order=ASC" style="<?= ($sort == 'course' && $order == 'ASC') ? 'color:red' : '' ?>">↑</a>
                <a href="?sort=course&order=DESC" style="<?= ($sort == 'course' && $order == 'DESC') ? 'color:red' : '' ?>">↓</a>
            </th>
            <th>
                Temps
                <a href="?sort=temps&order=ASC" style="<?= ($sort == 'temps' && $order == 'ASC') ? 'color:red' : '' ?>">↑</a>
                <a href="?sort=temps&order=DESC" style="<?= ($sort == 'temps' && $order == 'DESC') ? 'color:red' : '' ?>">↓</a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mesDonnees as $row): ?>
        <tr>
            <td><?= $row['nom'] ?></td>
            <td><?= $row['pays'] ?></td>
            <td><?= $row['course'] ?></td>
            <td><?= $row['temps'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>