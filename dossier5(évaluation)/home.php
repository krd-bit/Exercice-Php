<?php
require_once 'db.php';

$msg = "";

if (isset($_POST['ok'])) {
    $nom = $_POST['nom'];
    $pays = $_POST['pays'];
    $course = $_POST['course'];
    $temps = $_POST['temps'];

    if (strlen($pays) != 3) {
        $msg = "Le pays doit faire 3 lettres.";
    } elseif (!is_numeric($temps)) {
        $msg = "Le temps doit être un nombre.";
    } else {
        add($nom, strtoupper($pays), $course, $temps);
        $msg = "Ajouté avec succès !";
    }
}

$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;

$data = getAll($search, $page);
$nbPages = ceil(countAll($search) / 10);
$listCourses = getCourses();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>JO Evaluation</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #eee; }
        .box { background: #f4f4f4; padding: 15px; margin-top: 20px; border: 1px solid #ddd; }
    </style>
</head>
<body>

<h1>Résultats JO</h1>

<form>
    <input type="text" name="search" value="<?= $search ?>" placeholder="Rechercher...">
    <button>Filtrer</button>
</form>

<p style="color:blue; font-weight:bold"><?= $msg ?></p>

<table>
    <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Pays</th>
        <th>Course</th>
        <th>Temps</th>
        <th>Action</th>
    </tr>
    <?php 
    $rank = ($page - 1) * 10 + 1;
    foreach ($data as $row): 
    ?>
    <tr>
        <td><?= $rank++ ?></td>
        <td><?= $row['nom'] ?></td>
        <td><?= $row['pays'] ?></td>
        <td><?= $row['course'] ?></td>
        <td><?= $row['temps'] ?></td>
        <td><a href="update.php?id=<?= $row['id'] ?>">Modifier</a></td>
    </tr>
    <?php endforeach; ?>
</table>

<div style="margin-top: 10px;">
    Pages : 
    <?php for ($i = 1; $i <= $nbPages; $i++): ?>
        <a href="?page=<?= $i ?>&search=<?= $search ?>" style="margin-right:5px; font-weight:bold">[<?= $i ?>]</a>
    <?php endfor; ?>
</div>

<div class="box">
    <h3>Ajouter un résultat</h3>
    <form method="post">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="pays" placeholder="Pays (3 lettres)" required maxlength="3">
        <select name="course">
            <?php foreach ($listCourses as $c): ?>
                <option><?= $c ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="temps" placeholder="Temps" required>
        <button name="ok">Enregistrer</button>
    </form>
</div>

</body>
</html>