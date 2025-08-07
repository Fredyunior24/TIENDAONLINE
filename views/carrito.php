<?php
session_start();
require_once './config/database.php';

$cart = $_SESSION['cart'] ?? [];
$productos = [];

if ($cart) {
    $ids = implode(',', array_map('intval', $cart));
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mi Carrito</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; }
        .carrito-container { max-width: 600px; margin: 60px auto; background: #fff; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.13); padding: 30px; }
        h1 { text-align: center; font-size: 2.2em; margin-bottom: 30px; }
        .producto-carrito { display: flex; align-items: center; margin-bottom: 20px; }
        .producto-carrito img { width: 80px; border-radius: 8px; margin-right: 20px; }
        .producto-carrito div { flex: 1; }
    </style>
</head>
<body>
    <div class="carrito-container">
        <h1>Mi Carrito</h1>
        <?php if ($productos): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto-carrito">
                    <img src="public/images/<?= htmlspecialchars($producto['image']) ?>" alt="<?= htmlspecialchars($producto['name']) ?>">
                    <div>
                        <strong><?= htmlspecialchars($producto['name']) ?></strong><br>
                        $<?= $producto['price'] ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center;">No hay productos en el carrito.</p>
        <?php endif; ?>
    </div>
</body>
</html>