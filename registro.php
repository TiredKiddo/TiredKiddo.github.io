<!DOCTYPE html>
    
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="registro.css">
   
</head>
<body>
    <div class="container">
             <h2>Crea tu cuenta</h2>
        <form action="procesar.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Ingresa tu nombre completo:</label>
                <input type="text"   name="nombre" required>
            </div>
            <div class="form-group">
                <label for="user">Crea tu usuario:</label>
                <input type="text"  name="user" required>
            </div>
            <div class="form-group">
                <label for="email">Ingresa tu correo:</label>
                <input type="text"   name="email" required>
            </div>
            <div class="form-group">
                <label for="pass">Crea tu contraseña:</label>
                <input type="password" name="pass" required>
            </div>
            <div class="form-group">
            <label for="ima">Cargar imagen:</label>
            <input type="file" name="imagenc" required>
            </div>
            <div class="form-group">
            <input type="submit" name="accion" value="Crear Cuenta">
            </div>
        </form>
        <div class="register-link">
            <a href="login.php">Si ya tienes cuenta, inicia sesión</a>
        </div>
</body>
</html>
