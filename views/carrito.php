<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$cart = $_SESSION['cart'] ?? [];
$productos = [];

// Traer productos con cantidades
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
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8fafc; }
        .carrito-container { max-width: 600px; margin: 60px auto; background: #fff; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.13); padding: 30px; }
        h1 { text-align: center; font-size: 2.2em; margin-bottom: 30px; }
        .producto-carrito { display: flex; align-items: center; margin-bottom: 20px; }
        .producto-carrito img { width: 80px; border-radius: 8px; margin-right: 20px; }
        .producto-carrito div { flex: 1; }
        .acciones { display: flex; align-items: center; gap: 5px; }
        .acciones button { padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
        .sumar { background: green; color: white; }
        .restar { background: orange; color: white; }
        .eliminar { background: red; color: white; }
    </style>
</head>
<body>
    <div class="carrito-container">
        <h1>Mi Carrito</h1>
        <?php if ($productos): ?>
            <?php foreach ($productos as $producto): 
                $cantidad = $cart[$producto['id']] ?? 1; ?>
                <div class="producto-carrito" data-id="<?= $producto['id'] ?>">
                    <img src="../public/images/<?= htmlspecialchars($producto['image']) ?>" alt="<?= htmlspecialchars($producto['name']) ?>">

                    <div>
                        <strong><?= htmlspecialchars($producto['name']) ?></strong><br>
                        $<?= $producto['price'] ?>
                    </div>

                    <div class="acciones">
                        <button class="restar">-</button>
                        <span class="cantidad"><?= $cantidad ?></span>
                        <button class="sumar">+</button>
                        <button class="eliminar">x</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center;">No hay productos en el carrito.</p>
        <?php endif; ?>
    </div>

<script>
document.querySelectorAll(".sumar").forEach(btn => {
    btn.addEventListener("click", function() {
        let contenedor = this.closest(".producto-carrito");
        let cantidadElem = contenedor.querySelector(".cantidad");
        let id = contenedor.dataset.id;
        let nuevaCantidad = parseInt(cantidadElem.textContent) + 1;

        actualizarCantidad(id, nuevaCantidad, cantidadElem);
    });
});

document.querySelectorAll(".restar").forEach(btn => {
    btn.addEventListener("click", function() {
        let contenedor = this.closest(".producto-carrito");
        let cantidadElem = contenedor.querySelector(".cantidad");
        let id = contenedor.dataset.id;
        let nuevaCantidad = parseInt(cantidadElem.textContent) - 1;
        if (nuevaCantidad > 0) {
            actualizarCantidad(id, nuevaCantidad, cantidadElem);
        }
    });
});

document.querySelectorAll(".eliminar").forEach(btn => {
    btn.addEventListener("click", function() {
        let contenedor = this.closest(".producto-carrito");
        let id = contenedor.dataset.id;

        fetch("../eliminar_del_carrito.php", {
            method: "POST",
            body: new URLSearchParams({ id: id })
        }).then(() => {
            contenedor.remove();
        });
    });
});

function actualizarCantidad(id, cantidad, elem) {
    fetch("../actualizar_cantidad.php", {
        method: "POST",
        body: new URLSearchParams({ id: id, cantidad: cantidad })
    }).then(() => {
        elem.textContent = cantidad;
    });
}
</script>

</body>
</html>
