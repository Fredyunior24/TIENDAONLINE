<?php
require_once '../models/User.php';
$action = $_GET['action'] ?? '';

if ($action == 'register') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    User::register($name, $email, $password);
    header("Location: ../index.php?page=login");
} elseif ($action == 'login') {
    // Lógica básica de inicio de sesión...
}
