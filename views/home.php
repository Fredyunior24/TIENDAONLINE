<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inicio - Tienda Online</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .container {
            background: rgba(255,255,255,0.92);
            border-radius: 16px;
            max-width: 500px;
            margin: 80px auto;
            padding: 40px 30px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            margin-bottom: 30px;
            font-size: 2.5em;
            color: #333;
        }
        .btn-group {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }
        .btn {
            width: 90%;
            max-width: 400px;
            margin: 0 auto;
            padding: 18px;
            font-size: 1.2em;
            border: none;
            border-radius: 8px;
            background: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            box-sizing: border-box;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-secondary {
            background: #6c757d;
        }
        .btn-secondary:hover {
            background: #495057;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #a71d2a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido a la Tienda</h1>
        <div class="btn-group">
        <?php if (empty($_SESSION['user_id'])): ?>
            <a href="?page=login" class="btn">Iniciar Sesión</a>
        <?php else: ?>
            <a href="?page=catalogo" class="btn">Ver Productos</a>
            <a href="?page=agregar_producto" class="btn btn-secondary">Agregar Producto</a>
            <a href="?page=register" class="btn btn-secondary">Registrar Usuario</a>
            <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>
