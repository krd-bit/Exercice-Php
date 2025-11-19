<?php
require_once 'db.php';

if (!isset($_GET['id'])) {
    header('Location: home.php');
    exit;
}

$row = getOne($_GET['id']);
$msg = "";

if (isset($_POST['ok'])) {
    $pays = $_POST['pays'];
    $temps = $_POST['temps'];

    if (strlen($pays) != 3) {
        $msg = "Le pays doit faire 3 lettres.";
    } elseif (!is_numeric($temps)) {
        $msg = "Le temps doit être un nombre.";
    } else {
        update($_GET['id'], $_POST['nom'], strtoupper($pays), $_POST['course'], $temps);
        header('Location: home.php');
        exit;
    }
}

$listCourses = getCourses();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier</title>
    <style>body { font-family: sans-serif; padding: 20px; }</style>
</head>
<body>

<h1>Modifier un athlète</h1>
<p style="color:red"><?= $msg ?></p>

<form method="post">
    Nom : <br>
    <input type="text" name="nom" value="<?= $row['nom'] ?>" required><br><br>
    
    Pays (3 lettres) : <br>
    <input type="text" name="pays" value="<?= $row['pays'] ?>" maxlength="3" required><br><br>
    
    Course : <br>
    <select name="course">
        <?php foreach ($listCourses as $c): ?>
            <option <?= $c == $row['course'] ? 'selected' : '' ?>><?= $c ?></option>
        <?php endforeach; ?>
    </select><br><br>
    
    Temps : <br>
    <input type="text" name="temps" value="<?= $row['temps'] ?>" required><br><br>
    
    <button name="ok">Sauvegarder</button>
    <a href="home.php">Annuler</a>
</form>

</body>
</html>