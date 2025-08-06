<?php
require_once '../models/User.php';
session_start();
$action = $_GET['action'] ?? '';

if ($action == 'register') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    User::register($name, $email, $password);
    header("Location: ../index.php?page=login");
    exit();
} elseif ($action == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Usuario y contraseña fijos
    if ($email === 'freddy_alex24@hotmail.com' && $password === '1234') {
        $_SESSION['user_id'] = 1; // Puedes usar un ID fijo o el que corresponda
        $_SESSION['user_name'] = 'Fredyunior24';
        header("Location: ../index.php?page=home");
        exit();
    } else {
        // Si falla, redirige al login con un mensaje de error
        header("Location: ../index.php?page=login&error=1");
        exit();
    }
}
