<?php
// filepath: c:\Users\fredd\OneDrive\Escritorio\tiendaonline\eliminar_del_carrito.php
session_start();
$product_id = $_POST['product_id'] ?? null;

if ($product_id && isset($_SESSION['cart'])) {
    $key = array_search($product_id, $_SESSION['cart']);
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindexa el array
    }
}
header("Location: views/carrito.php");
exit();