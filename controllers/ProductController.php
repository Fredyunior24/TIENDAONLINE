<?php
require_once __DIR__ . '/../config/database.php';
;
; // antes estaba ../config/database.php

$action = $_GET['action'] ?? '';

if ($action === 'guardar') {
    $name     = $_POST['name'] ?? '';
    $desc     = $_POST['description'] ?? '';
    $price    = $_POST['price'] ?? 0;
    $size     = $_POST['size'] ?? '';
    $color    = $_POST['color'] ?? '';
    $stock    = $_POST['stock'] ?? 0;
    $category = $_POST['category'] ?? '';

    // Directorios (FS = disco, URL = navegador)
    $uploadDirFs  = __DIR__ . '/../public/images/';
    $uploadDirUrl = '/public/images/';

    if (!is_dir($uploadDirFs)) {
        mkdir($uploadDirFs, 0777, true);
    }

    $imageDb = null;
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $base = preg_replace('/[^a-z0-9_\-\.]/i', '_', pathinfo($_FILES['image']['name'], PATHINFO_FILENAME));
        $filename = time() . '_' . $base . '.' . $ext;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirFs . $filename)) {
            // Opción A: guarda solo el nombre
            $imageDb = $filename;

            // (Si prefieres guardar la ruta completa web:)
            // $imageDb = $uploadDirUrl . $filename;
        }
    }

    // INSERT producto (ajusta nombres de columnas reales)
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, size, color, stock, category, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $desc, $price, $size, $color, $stock, $category, $imageDb]);

    header("Location: ../index.php?page=catalogo&added=1");
    exit;
}
