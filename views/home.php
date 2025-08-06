<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inicio - Tienda Online</title>
</head>
<body>
    <h1>Bienvenido a la Tienda</h1>
    <?php if (empty($_SESSION['user_id'])): ?>
        <a href="?page=login">Iniciar Sesión</a> | 
        <a href="?page=register">Registrarse</a>
    <?php else: ?>
        <a href="?page=catalogo">Ver Productos</a>
        <a href="?page=agregar_producto">Agregar Producto</a>
        <a href="logout.php">Cerrar Sesión</a>
    <?php endif; ?>
</body>
</html>
