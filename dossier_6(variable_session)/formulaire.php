<?php
session_start();

if (isset($_POST['deconnexion'])) {
    unset($_SESSION['username']);
}

if (isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TP Sessions</title>
</head>
<body>

<?php if (isset($_SESSION['username'])): ?>

    <h1>Bonjour <?= $_SESSION['username'] ?></h1>
    
    <form method="post">
        <button name="deconnexion">Se déconnecter</button>
    </form>

<?php else: ?>

    <h1>Login</h1>
    <form method="post">
        <label>Username :</label>
        <input type="text" name="username">
        <button>Valider</button>
    </form>

<?php endif; ?>

</body>
</html>