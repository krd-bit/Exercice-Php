<?php
function connect() {
    try {
        return new PDO('mysql:host=localhost;dbname=jo;charset=utf8', 'root', 'Ibrakid213%');
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function getCourses() {
    return connect()->query("SELECT DISTINCT course FROM joooo.`100` ORDER BY course")->fetchAll(PDO::FETCH_COLUMN);
}

function add($nom, $pays, $course, $temps) {
    $sql = "INSERT INTO joooo.`100` (nom, pays, course, temps) VALUES (?, ?, ?, ?)";
    connect()->prepare($sql)->execute([$nom, $pays, $course, $temps]);
}

function getAll($search, $page) {
    $offset = ($page - 1) * 10;
    $sql = "SELECT * FROM joooo.`100` WHERE nom LIKE ? ORDER BY temps ASC LIMIT 10 OFFSET $offset";
    $stmt = connect()->prepare($sql);
    $stmt->execute(["%$search%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countAll($search) {
    $stmt = connect()->prepare("SELECT COUNT(*) FROM joooo.`100` WHERE nom LIKE ?");
    $stmt->execute(["%$search%"]);
    return $stmt->fetchColumn();
}

function getOne($id) {
    $stmt = connect()->prepare("SELECT * FROM joooo.`100` WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function update($id, $nom, $pays, $course, $temps) {
    $sql = "UPDATE joooo.`100` SET nom=?, pays=?, course=?, temps=? WHERE id=?";
    connect()->prepare($sql)->execute([$nom, $pays, $course, $temps, $id]);
}
?>