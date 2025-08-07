<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Agregar Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        :root{
            --bg:#f5f6fa;
            --card:#ffffff;
            --text:#2d2d2d;
            --muted:#6b7280;
            --primary:#2563eb;
            --primary-600:#1d4ed8;
            --ring:rgba(37,99,235,.25);
            --ok:#10b981;
            --danger:#ef4444;
            --border:#e5e7eb;
        }
        *{box-sizing:border-box}
        html,body{height:100%}
        body{
            margin:0;
            background:linear-gradient(135deg,#f8fafc, #eef2ff);
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
            color:var(--text);
        }
        .topbar{
            position:sticky; top:0; z-index:10;
            backdrop-filter:saturate(180%) blur(10px);
            background:rgba(255,255,255,.7);
            border-bottom:1px solid var(--border);
        }
        .topbar-inner{
            max-width:1100px; margin:0 auto; padding:12px 20px;
            display:flex; align-items:center; gap:12px; justify-content:space-between;
        }
        .icon-btn{
            text-decoration:none; display:inline-flex; align-items:center; justify-content:center;
            width:42px; height:42px; border-radius:999px; border:1px solid var(--border);
            background:#fff; font-size:20px; color:var(--text);
            box-shadow: 0 1px 2px rgba(16,24,40,.06);
        }
        .icon-btn:hover{transform:translateY(-1px)}
        .brand{font-weight:700; letter-spacing:.2px}
        .wrap{
            max-width:1100px; margin:24px auto; padding:0 20px 40px;
        }
        .grid{
            display:grid; grid-template-columns:1.1fr .9fr; gap:24px;
        }
        @media (max-width: 900px){ .grid{grid-template-columns:1fr} }

        .card{
            background:var(--card); border:1px solid var(--border);
            border-radius:18px; box-shadow:0 10px 25px rgba(16,24,40,.08);
            overflow:hidden;
        }
        .card-header{
            padding:18px 20px; border-bottom:1px solid var(--border);
            display:flex; align-items:center; justify-content:space-between;
        }
        .card-title{margin:0; font-size:18px}
        .card-sub{margin:4px 0 0; font-size:13px; color:var(--muted)}
        .card-body{padding:20px}

        .form-row{display:grid; grid-template-columns:1fr 1fr; gap:16px}
        @media (max-width: 700px){ .form-row{grid-template-columns:1fr} }

        label{display:block; font-size:13px; color:var(--muted); margin:0 0 6px 2px}
        input[type="text"], input[type="number"], textarea, select{
            width:100%; padding:12px 14px; font-size:15px;
            border:1px solid var(--border); border-radius:12px; outline:none;
            background:#fff;
        }
        textarea{min-height:110px; resize:vertical}
        input:focus, textarea:focus, select:focus{
            border-color:var(--primary);
            box-shadow:0 0 0 6px var(--ring);
        }

        .file{
            border:1px dashed #cbd5e1; border-radius:12px; padding:18px;
            background:#fafafa;
            text-align:center; cursor:pointer;
        }
        .file input{display:none}
        .file span{display:block; font-size:14px; color:var(--muted)}
        .preview{
            margin-top:12px; border:1px solid var(--border); border-radius:12px; overflow:hidden;
            display:none;
        }
        .preview img{width:100%; height:auto; display:block}

        .actions{
            display:flex; gap:12px; justify-content:flex-end; margin-top:18px;
        }
        .btn{
            padding:12px 16px; border-radius:12px; border:1px solid transparent;
            font-weight:600; cursor:pointer; font-size:15px;
        }
        .btn.secondary{
            background:#fff; border-color:var(--border); color:var(--text);
        }
        .btn.primary{
            background:var(--primary); color:#fff;
        }
        .btn.primary:hover{background:var(--primary-600)}
        .hint{font-size:12px; color:var(--muted); margin-top:6px}

        .badge{
            display:inline-block; padding:6px 10px; border-radius:999px;
            font-size:12px; background:#eef2ff; color:#3730a3; border:1px solid #e0e7ff;
        }
    </style>
</head>
<body>

   
    <div class="topbar">
        <div class="topbar-inner">
            <!-- volver -->
            <a class="icon-btn" href="../index.php?page=home" title="Volver">⬅️</a>

            <div class="brand">Panel de Productos</div>

            <!-- carrito -->
            <a class="icon-btn" href="../index.php?page=carrito" title="Carrito">🛒</a>
        </div>
    </div>

    <div class="wrap">
        <div class="grid">
            <!-- Formulario -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Agregar nuevo producto</h3>
                        <p class="card-sub">Completa la información del producto y súbelo al catálogo.</p>
                    </div>
                    <span class="badge">Nuevo</span>
                </div>
                <div class="card-body">
                    <!-- Ajusta el action si usas router: ../index.php?page=guardar_producto -->
                    <form action="controllers/ProductController.php?action=guardar" method="POST" enctype="multipart/form-data" id="productForm" novalidate>
                        <div class="form-row">
                            <div>
                                <label for="name">Nombre del producto</label>
                                <input type="text" id="name" name="name" placeholder="Ej: Zapatillas Urban" required>
                            </div>
                            <div>
                                <label for="price">Precio</label>
                                <input type="number" id="price" name="price" min="0" step="0.01" placeholder="Ej: 199.99" required>
                                <div class="hint">Usa punto para decimales (ej: 99.90)</div>
                            </div>
                        </div>

                        <div>
                            <label for="description">Descripción</label>
                            <textarea id="description" name="description" placeholder="Características, materiales, cuidados..."></textarea>
                        </div>

                        <div class="form-row">
                            <div>
                                <label for="size">Talla</label>
                                <input type="text" id="size" name="size" placeholder="Ej: S, M, L, 40, 41">
                            </div>
                            <div>
                                <label for="color">Color</label>
                                <input type="text" id="color" name="color" placeholder="Ej: Negro, Blanco">
                            </div>
                        </div>

                        <div class="form-row">
                            <div>
                                <label for="stock">Stock</label>
                                <input type="number" id="stock" name="stock" min="0" step="1" placeholder="Cantidad en inventario">
                            </div>
                            <div>
                                <label for="category">Categoría</label>
                                <input type="text" id="category" name="category" placeholder="Ej: Calzado, Ropa, Accesorios">
                            </div>
                        </div>

                        <div>
                            <label>Imagen del producto</label>
                            <label class="file">
                                <input type="file" id="image" name="image" accept="image/*">
                                <strong>Haz clic para seleccionar</strong>
                                <span>PNG, JPG. Máx. 2 MB</span>
                            </label>
                            <div class="preview" id="preview">
                                <img id="previewImg" alt="Vista previa">
                            </div>
                        </div>

                        <div class="actions">
                            <a class="btn secondary" href="../index.php?page=catalogo">Cancelar</a>
                            <button type="submit" class="btn primary">Guardar producto</button>
                        </div>
                    </form>
                </div>
            </div>

            <!--  Tips -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recomendaciones</h3>
                </div>
                <div class="card-body">
                    <ul style="margin:0; padding-left:18px; line-height:1.7;">
                        <li>Usa un <strong>nombre claro</strong> y breve.</li>
                        <li>La descripción ayuda a vender: materiales, medidas y cuidados.</li>
                        <li>Imágenes bien iluminadas y <strong>fondo neutro</strong>.</li>
                        <li>Actualiza el <strong>stock</strong> para evitar ventas sin inventario.</li>
                        <li>Verifica el <strong>precio</strong> con 2 decimales.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Vista previa de imagen
    const input = document.getElementById('image');
    const preview = document.getElementById('preview');
    const img = document.getElementById('previewImg');

    input?.addEventListener('change', function(){
        const file = this.files && this.files[0];
        if(!file){ preview.style.display='none'; return; }
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    });

    // Validación básica del formulario
    document.getElementById('productForm')?.addEventListener('submit', function(e){
        const price = document.getElementById('price');
        if (price && parseFloat(price.value) < 0) {
            e.preventDefault();
            alert('El precio no puede ser negativo.');
        }
    });
    </script>
</body>
</html>
