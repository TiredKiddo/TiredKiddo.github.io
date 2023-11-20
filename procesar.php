<?php
include("session.php"); // Asegúrate de que el archivo "conexion.php" contenga la función Conectarse() utilizando mysql_.



// Verificar si se envió el formulario
if (isset($_POST['accion']) && $_POST['accion'] === 'Crear Cuenta') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $usuario = $_POST['user'];
    $correo = $_POST['email'];
    $contrasena = $_POST['pass'];
    $archivo = addslashes(file_get_contents($_FILES['imagenc']['tmp_name']));

    // Escapar los datos para prevenir SQL injection
    $nombre = mysqli_real_escape_string($conexion, $nombre);
    $usuario = mysqli_real_escape_string($conexion, $usuario);
    $correo = mysqli_real_escape_string($conexion, $correo);
    $contrasena = mysqli_real_escape_string($conexion, $contrasena);
    
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO registro (nombre_c, user_new, correo, contrasena, imagen) VALUES ('$nombre', '$usuario',
     '$correo', '$contrasena', '$archivo')";

    if (mysqli_query($conexion, $sql)) {
        $mensaje = "Registro exitoso. Tu cuenta ha sido creada.";
        header("Location: registro.php?mensaje=" . urlencode($mensaje));
        exit();
    } else {
        $mensaje = "Error al registrar la cuenta: " . mysqli_error($conexion);
        header("Location: registro.php?mensaje=" . urlencode($mensaje));
        exit();
    }
    
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>