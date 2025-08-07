<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: rgba(255,255,255,0.95);
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 {
            font-size: 2.2em;
            margin-bottom: 30px;
            color: #333;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 16px;
            margin: 15px 0;
            font-size: 1.2em;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 16px;
            font-size: 1.2em;
            border: none;
            border-radius: 8px;
            background: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
            margin-top: 20px;
        }
        button:hover {
            background: #0056b3;
            transform: scale(1.03);
        }
        .error {
            color: #dc3545;
            margin-bottom: 18px;
            font-size: 1.1em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php if (isset($_GET['error'])): ?>
            <div class="error">
                Usuario o contraseña incorrectos.
            </div>
        <?php endif; ?>
        <form method="post" action="controllers/UserController.php?action=login">
            <h2>Iniciar Sesión</h2>
            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
