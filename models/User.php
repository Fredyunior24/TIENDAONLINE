<?php
require_once '../config/database.php';

class User {
    public static function register($name, $email, $password) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
    }
}
