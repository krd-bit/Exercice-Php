<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=jo;charset=utf8', 'root', 'Ibrakid213%');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("DROP TABLE IF EXISTS message");
    $pdo->exec("DROP TABLE IF EXISTS user");

    $sqlUser = "CREATE TABLE user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL
    )";
    $pdo->exec($sqlUser);

    $sqlMsg = "CREATE TABLE message (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        message TEXT NOT NULL
    )";
    $pdo->exec($sqlMsg);

    echo "Tables installées.";

} catch (Exception $e) {
    die($e->getMessage());
}
?>