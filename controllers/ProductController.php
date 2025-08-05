<?php
require_once '../config/database.php';

$action = $_GET['action'] ?? '';

if ($action == 'guardar') 
{
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];

    // Guardar imagen en carpeta
    $imageName = null;
    if (!empty($_FILES['image']['name'])) 
    {
        $imageName = time() . '_' . basename($_FILES['image']['name']); // evitar duplicados
        $targetPath = "../public/images/" . $imageName;

        // Validar que sea imagen
        $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($ext, $allowed)) 
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
        } 
        else 
        {
            die("Formato de imagen no permitido.");
        }
    }



    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, size, color, stock, category, image) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $desc, $price, $size, $color, $stock, $category, $imageName]);

    header("Location: ../index.php?page=catalogo");
    exit;
}
