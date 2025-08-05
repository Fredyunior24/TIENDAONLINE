<?php
require_once './config/database.php';

$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Productos</title>
</head>
<body>
    <h1>Catálogo de Productos</h1>
    <div style="display: flex; flex-wrap: wrap;">
        <?php foreach ($productos as $producto): ?>
            <div style="border: 1px solid #ccc; margin: 10px; padding: 10px; width: 200px;">
                <h3><?= htmlspecialchars($producto['name']) ?></h3>
                <img src="public/images/<?= htmlspecialchars($producto['image']) ?>" alt="<?= htmlspecialchars($producto['name']) ?>" style="max-width: 100%;">
                <p><?= htmlspecialchars($producto['description']) ?></p>
                <strong>Precio:</strong> $<?= $producto['price'] ?><br>
                <small>Talla: <?= $producto['size'] ?> | Color: <?= $producto['color'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>