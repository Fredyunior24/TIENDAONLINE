<?php
session_start();
$product_id = $_POST['product_id'] ?? null;
$action = $_POST['action'] ?? null;
$result = [];

if ($product_id && isset($_SESSION['cart'][$product_id])) {
    if ($action === 'increment') {
        $_SESSION['cart'][$product_id]++;
    } elseif ($action === 'decrement') {
        if ($_SESSION['cart'][$product_id] > 1) {
            $_SESSION['cart'][$product_id]--;
        }
        // Si es 1, no baja más
    }
    $result['cantidad'] = $_SESSION['cart'][$product_id];
}
echo json_encode($result);
exit;