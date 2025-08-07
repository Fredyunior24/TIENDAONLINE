<?php
require_once '../models/User.php';
session_start();

$action = $_GET['action'] ?? '';

if ($action === 'register') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    // Guarda hasheado
    $passwordHash = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

    User::register($name, $email, $passwordHash);
    header("Location: ../index.php?page=login");
    exit();

} elseif ($action === 'login') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // 1) Usuario fijo (conservado)
    if ($email === 'freddy_alex24@hotmail.com' && $password === '1234') {
        $_SESSION['user_id'] = 1;
        $_SESSION['user_name'] = 'Fredyunior24';
        $_SESSION['user_email'] = $email;
        header("Location: ../index.php?page=home");
        exit();
    }

    // 2) Usuario en BD
    $user = User::findByEmail($email);

    if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
        $_SESSION['user_id']    = $user['id'];
        $_SESSION['user_name']  = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: ../index.php?page=home");
        exit();
    }

    // Fallo
    header("Location: ../index.php?page=login&error=1");
    exit();
}
