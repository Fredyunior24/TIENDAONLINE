<?php if (isset($_GET['error'])): ?>
    <div style="color: red; margin-bottom: 10px;">
        Usuario o contraseña incorrectos.
    </div>
<?php endif; ?>

<form method="post" action="controllers/UserController.php?action=login">
    <h2>Iniciar Sesión</h2>
    <input type="email" name="email" placeholder="Correo" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
</form>
