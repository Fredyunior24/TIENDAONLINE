<?php
$page = $_GET['page'] ?? 'home';
switch ($page) {
    case 'login':
        require 'views/login.php';
        break;
    case 'register':
        require 'views/register.php';
        break;
    default:
        require 'views/home.php';
        break;
}
