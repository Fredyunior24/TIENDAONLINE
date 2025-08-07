<?php
require_once '../config/database.php';

class User {
    public static function register($name, $email, $password) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
    }
    // Busca un usuario por email
    public static function findByEmail($email) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
}
