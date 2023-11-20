<?php

include("session.php");

$username = $_POST["username"];
$pass = $_POST["pass"];

// Consultar la base de datos para verificar las credenciales
$sql = "SELECT * FROM registro WHERE user_new = '$username' AND contrasena = '$pass'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 1) {
    // Inicio de sesión exitoso
    include("session.php");
    $_SESSION["username"] = $username;
    header("Location: inicioU.php"); // Redirigir a la página de inicio después del inicio de sesión
} else {
    $mensaje = "Error al iniciar sesión: " . mysqli_error($conexion);
        header("Location: login.php?mensaje=" . urlencode($mensaje));
        exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
