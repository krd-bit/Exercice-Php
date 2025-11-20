<?php
session_start();

try {
    $pdo = new PDO('mysql:host=localhost;dbname=jo;charset=utf8', 'root', 'Ibrakid213%');
} catch (Exception $e) {
    die($e->getMessage());
}

$msg = "";

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

if (isset($_POST['btn_inscription'])) {
    $pseudo = $_POST['username'];
    $mdp = $_POST['password'];

    if (empty($pseudo) || empty($mdp)) {
        $msg = "Remplissez tout svp !";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$pseudo]);
        
        if ($stmt->fetch()) {
            $msg = "Déjà pris ! Choisissez un autre pseudo.";
        } else {
            $mdp_crypte = password_hash($mdp, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
            $insert->execute([$pseudo, $mdp_crypte]);
            $msg = "Compte créé ! Connectez-vous maintenant.";
        }
    }
}

if (isset($_POST['btn_connexion'])) {
    $pseudo = $_POST['username'];
    $mdp = $_POST['password'];

    if (empty($pseudo) || empty($mdp)) {
        $msg = "Il manque le pseudo ou le mot de passe.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$pseudo]);
        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($mdp, $utilisateur['password'])) {
            $_SESSION['user'] = $utilisateur['username'];
        } else {
            $msg = "Mauvais identifiant ou mot de passe.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mon Espace Membre</title>
</head>
<body>

    <p class="message"><?= $msg ?></p>

    <?php if (isset($_SESSION['user'])): ?>
        
        <h1>Bonjour <?= $_SESSION['user'] ?> !</h1>
        <form method="post">
            <button name="logout">Se déconnecter</button>
        </form>

    <?php else: ?>

        <h3>Inscription</h3>
        <form method="post">
            <input type="text" name="username" placeholder="Votre pseudo"><br>
            <input type="password" name="password" placeholder="Votre mot de passe"><br>
            <button name="btn_inscription">Créer mon compte</button>
        </form>

        <h3>Connexion</h3>
        <form method="post">
            <input type="text" name="username" placeholder="Votre pseudo"><br>
            <input type="password" name="password" placeholder="Votre mot de passe"><br>
            <button name="btn_connexion">Me connecter</button>
        </form>

    <?php endif; ?>

</body>
</html>