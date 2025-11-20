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
    $nom = $_POST['name'];
    $mdp = $_POST['password'];

    if (empty($pseudo) || empty($nom) || empty($mdp)) {
        $msg = "Tout remplir svp.";
    } else {
        $check = $pdo->prepare("SELECT * FROM user WHERE username = ?");
        $check->execute([$pseudo]);
        if ($check->fetch()) {
            $msg = "Pseudo déjà pris.";
        } else {
            $pass = password_hash($mdp, PASSWORD_DEFAULT);
            $ins = $pdo->prepare("INSERT INTO user (username, password, name) VALUES (?, ?, ?)");
            $ins->execute([$pseudo, $pass, $nom]);
            $msg = "Inscrit ! Connectez-vous.";
        }
    }
}

if (isset($_POST['btn_connexion'])) {
    $pseudo = $_POST['username'];
    $mdp = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->execute([$pseudo]);
    $user = $stmt->fetch();

    if ($user && password_verify($mdp, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['name'] = $user['name']; 
    } else {
        $msg = "Erreur login.";
    }
}

if (isset($_POST['btn_message']) && isset($_SESSION['name'])) {
    $message_text = $_POST['message'];
    if (!empty($message_text)) {
        $ins = $pdo->prepare("INSERT INTO message (name, message) VALUES (?, ?)");
        $ins->execute([$_SESSION['name'], $message_text]);
    }
}

$messages = $pdo->query("SELECT * FROM message ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>TP Final</title>
    <style>
        body { font-family: sans-serif; background-color: #f0f2f5; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1, h2 { color: #333; }
        .error { color: red; font-weight: bold; }
        input, textarea { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;}
        button { background-color: #007bff; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%; }
        button:hover { background-color: #0056b3; }
        .msg-box { border-bottom: 1px solid #eee; padding: 10px 0; }
        .auteur { font-weight: bold; color: #555; }
        .logout-btn { background-color: #dc3545; margin-top: 10px; }
        .grid { display: flex; gap: 20px; }
        .half { width: 50%; }
    </style>
</head>
<body>

<div class="container">
    <p class="error"><?= $msg ?></p>

    <?php if (isset($_SESSION['user'])): ?>

        <h1>Espace Discussion</h1>
        <p>Bonjour <strong><?= $_SESSION['name'] ?? $_SESSION['user'] ?></strong></p>

        <div style="background: #e9ecef; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <h3>Nouveau message</h3>
            <form method="post">
                <textarea name="message" rows="3" placeholder="Votre message..." required></textarea>
                <button name="btn_message">Envoyer</button>
            </form>
        </div>

        <h3>Fil d'actualité</h3>
        <?php foreach ($messages as $m): ?>
            <div class="msg-box">
                <span class="auteur"><?= htmlspecialchars($m['name']) ?> :</span>
                <span><?= htmlspecialchars($m['message']) ?></span>
            </div>
        <?php endforeach; ?>

        <form method="post">
            <button name="logout" class="logout-btn">Se déconnecter</button>
        </form>

    <?php else: ?>

        <h1>Bienvenue</h1>
        <div class="grid">
            <div class="half">
                <h3>Inscription</h3>
                <form method="post">
                    <input type="text" name="username" placeholder="Username (Login)" required>
                    <input type="text" name="name" placeholder="Votre Nom (Affiché)" required>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <button name="btn_inscription">S'inscrire</button>
                </form>
            </div>
            <div class="half">
                <h3>Connexion</h3>
                <form method="post">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <button name="btn_connexion">Se connecter</button>
                </form>
            </div>
        </div>

    <?php endif; ?>
</div>

</body>
</html>