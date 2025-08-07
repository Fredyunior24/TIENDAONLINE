<?php
session_start();
require_once './config/database.php'; // Ajusta la ruta si es necesario

$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Catálogo de Productos</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            /* Fondo animado con gradiente */
            background: linear-gradient(-45deg, #f8fafc, #e0c3fc, #8ec5fc, #e0c3fc);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        h1 {
            text-align: center;
            font-size: 2.8em;
            color: #333;
            margin-top: 40px;
            margin-bottom: 30px;
            letter-spacing: 2px;
        }

        .catalogo-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            padding: 20px;
        }

        .producto-card {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.13);
            width: 260px;
            padding: 24px 18px;
            margin-bottom: 20px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .producto-card:hover {
            transform: scale(1.04);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.18);
        }

        .producto-card h3 {
            font-size: 1.5em;
            color: #007bff;
            margin-bottom: 10px;
        }

        .producto-card img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        }

        .producto-card p {
            font-size: 1.15em;
            color: #444;
            margin-bottom: 10px;
        }

        .producto-card strong {
            font-size: 1.2em;
            color: #333;
        }

        .producto-card small {
            display: block;
            margin-top: 8px;
            font-size: 1.05em;
            color: #666;
        }

        .cart-icon {
            position: fixed;
            top: 30px;
            right: 40px;
            z-index: 1000;
            text-decoration: none;
            color: #333;
            font-size: 2em;
        }

        .cart-icon span {
            background: #28a745;
            color: #fff;
            border-radius: 50%;
            padding: 4px 10px;
            font-size: 0.7em;
            position: relative;
            top: -10px;
            left: -10px;
        }
    </style>
</head>

<body>
    <h1>Catálogo de Productos</h1>
    <?php if (isset($_GET['added'])): ?>
        <div style="text-align:center; color:#28a745; font-size:1.2em; margin-bottom:20px;">
            Producto agregado al carrito.
        </div>
    <?php endif; ?>
    <div class="catalogo-container">
        <?php foreach ($productos as $producto): ?>
            <div class="producto-card">
                <h3><?= htmlspecialchars($producto['name']) ?></h3>
                <img src="public/images/<?= htmlspecialchars($producto['image']) ?>" alt="<?= htmlspecialchars($producto['name']) ?>">
                <p><?= htmlspecialchars($producto['description']) ?></p>
                <strong>Precio:</strong> $<?= $producto['price'] ?><br>
                <small>Talla: <?= $producto['size'] ?> | Color: <?= $producto['color'] ?></small>
                <form method="post" action="../add_to_cart.php" style="margin-top:15px;">
                    <input type="hidden" name="product_id" value="<?= $producto['id'] ?>">
                    <button type="submit" style="
                        width: 100%;
                        padding: 12px;
                        font-size: 1.1em;
                        border: none;
                        border-radius: 8px;
                        background: #28a745;
                        color: #fff;
                        cursor: pointer;
                        transition: background 0.2s, transform 0.2s;
                    ">Agregar al carrito</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <div style="position:fixed; top:30px; right:40px; z-index:1000;">
        <a href="../views/carrito.php" style="text-decoration:none; color:#333; font-size:2em;">
            🛒
            <?php
            $cantidad = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
            if ($cantidad > 0) {
                echo "<span style='background:#28a745; color:#fff; border-radius:50%; padding:4px 10px; font-size:0.7em; position:relative; top:-10px; left:-10px;'>$cantidad</span>";
            }
            ?>
        </a>
    </div>
    <div style="position:fixed; top:30px; left:40px; z-index:1000;">
        <a href="../index.php?page=home" style="text-decoration:none; color:#333; font-size:2em;">⬅️</a>
    </div>

</body>

</html>