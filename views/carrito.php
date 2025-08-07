<?php
session_start();
require_once '../config/database.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$cart = $_SESSION['cart'] ?? [];
$productos = [];

if ($cart) {
    $ids = implode(',', array_map('intval', array_keys($cart)));
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mi Carrito</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: url('https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .carrito-container {
            max-width: 700px;
            margin: 60px auto;
            background: rgba(255,255,255,0.96);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            padding: 40px 35px;
        }
        h1 {
            text-align: center;
            font-size: 2.7em;
            margin-bottom: 35px;
            color: #222;
            letter-spacing: 2px;
        }
        .producto-carrito {
            display: flex;
            align-items: center;
            margin-bottom: 28px;
            background: rgba(245,245,245,0.85);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 18px 14px;
        }
        .producto-carrito img {
            width: 90px;
            border-radius: 10px;
            margin-right: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.09);
        }
        .producto-carrito div {
            flex: 1;
            font-size: 1.25em;
            color: #333;
        }
        .producto-carrito strong {
            font-size: 1.25em;
            color: #007bff;
        }
        .producto-carrito form {
            margin-left: 20px;
        }
        .producto-carrito button {
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 10px 22px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }
        .producto-carrito button:hover {
            background: #a71d2a;
            transform: scale(1.05);
        }
        .empty-cart {
            text-align: center;
            font-size: 1.3em;
            color: #555;
            margin-top: 40px;
        }
    </style>
    <script>
function actualizarCantidad(productId, action, btn) {
    fetch('../actualizar_cantidad.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'product_id=' + productId + '&action=' + action
    })
    .then(response => response.json())
    .then(data => {
        if (data.cantidad !== undefined) {
            document.getElementById('cantidad-' + productId).textContent = data.cantidad;
        } else {
            // Si se eliminó el producto, recarga la página para actualizar la lista
            location.reload();
        }
    });
}
    </script>
</head>
<body>
    <video autoplay muted loop id="bg-video" style="
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100vw;
        min-height: 100vh;
        z-index: -1;
        object-fit: cover;
        filter: brightness(0.7) blur(1px);
    ">
        <source src="https://assets.mixkit.co/videos/preview/mixkit-fashionable-woman-walking-on-the-street-3436-large.mp4" type="video/mp4">
        Tu navegador no soporta video HTML5.
    </video>
    <div class="carrito-container">
        <h1>Mi Carrito</h1>
        <?php if ($productos): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto-carrito">
                    <img src="../public/images/<?= htmlspecialchars($producto['image']) ?>" alt="<?= htmlspecialchars($producto['name']) ?>">
                    <div>
                        <strong><?= htmlspecialchars($producto['name']) ?></strong><br>
                        $<?= $producto['price'] ?><br>
                        <form class="cantidad-form" data-product="<?= $producto['id'] ?>" style="display:inline;">
                            <button type="button" onclick="actualizarCantidad(<?= $producto['id'] ?>, 'decrement', this)">-</button>
                            <span id="cantidad-<?= $producto['id'] ?>" style="font-size:1.2em; margin:0 10px;">
                                <?= $_SESSION['cart'][$producto['id']] ?>
                            </span>
                            <button type="button" onclick="actualizarCantidad(<?= $producto['id'] ?>, 'increment', this)">+</button>
                        </form>
                    </div>
                    <form method="post" action="../eliminar_del_carrito.php" style="margin-left:20px;">
                        <input type="hidden" name="product_id" value="<?= $producto['id'] ?>">
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-cart">No hay productos en el carrito.</div>
        <?php endif; ?>
    </div>
    <div style="
        position: absolute;
        top: 60px;
        right: 60px;
        display: flex;
        flex-direction: column;
        gap: 18px;
        align-items: flex-end;
    ">
        <a href="catalogo.php" style="
            background: #232323;
            color: #fff;
            border: 2px solid #ff9800;
            border-radius: 8px;
            padding: 16px 32px;
            font-size: 1.1em;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            letter-spacing: 1px;
            margin-bottom: 0;
            width: 260px;
            text-align: center;
        " onmouseover="this.style.background='#444'" onmouseout="this.style.background='#232323'">
            SEGUIR COMPRANDO
        </a>
        <a href="checkout.php" style="
            background: #ff9800;
            color: #fff;
            border: 2px solid #ff9800;
            border-radius: 8px;
            padding: 16px 32px;
            font-size: 1.1em;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            letter-spacing: 1px;
            width: 260px;
            text-align: center;
        " onmouseover="this.style.background='#e67c00'" onmouseout="this.style.background='#ff9800'">
            FINALIZAR COMPRA
        </a>
    </div>
</body>
</html>