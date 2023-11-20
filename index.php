<!DOCTYPE html>

<html>
<head>
    <title>Kiddo Sound</title>
    <link rel="stylesheet" href="master.css">
</head>
<body>
    <div class="container">
        <h2>Kiddo log</h2>
        <form action="login_proceso.php" method="post">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text"  id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password"  id="pass" name="pass" required>
            </div>
            <div class="form-group">
            <input type="submit" value="Iniciar Sesión">
            </div>
        </form>
        <div class="register-link">
            <a href="registro.php">Si aún no tiene una cuenta, regístrese aquí</a>
        </div>
    </div>
</body>
</html>
