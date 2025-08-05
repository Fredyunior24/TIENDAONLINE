<!DOCTYPE html>
<html>
<head>
    <title>Agregar Producto</title>
</head>
<body>
    <h2>Agregar nuevo producto</h2>
    <form action="controllers/ProductController.php?action=guardar" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Nombre del producto" required><br>
        <textarea name="description" placeholder="Descripción"></textarea><br>
        <input type="number" step="0.01" name="price" placeholder="Precio" required><br>
        <input type="text" name="size" placeholder="Talla"><br>
        <input type="text" name="color" placeholder="Color"><br>
        <input type="number" name="stock" placeholder="Stock"><br>
        <input type="text" name="category" placeholder="Categoría"><br>
        
        
        <label>Imagen:</label>
        <input type="file" name="image" accept="image/*"><br><br>
        <button type="submit">Guardar producto</button>
    </form>
</body>
</html>
