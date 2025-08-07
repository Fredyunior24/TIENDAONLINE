<?php
$page = $_GET['page'] ?? 'home';
switch ($page) {
    case 'login':
        require 'views/login.php';
        break;
    case 'register':
        require 'views/register.php';
        break;
    case 'catalogo':
        require 'views/catalogo.php';
        break;
    case 'agregar_producto':
        require 'views/agregar_producto.php';
        break;
    case 'product':
        require 'views/product.php';
        break;
    default:
        require 'views/home.php';
        break;
}
