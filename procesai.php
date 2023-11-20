<?php
include("session.php"); 

// Verificar si se envió el formulario
if (isset($_POST['accion']) && $_POST['accion'] === 'Agregar producto') {
    // Obtener los datos del formulario
    $nombre_p = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio_p = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $archivo = addslashes(file_get_contents($_FILES['imageni']['tmp_name']));

    // Escapar los datos para prevenir SQL injection
    $nombre_p = mysqli_real_escape_string($conexion, $nombre_p);
    $descripcion = mysqli_real_escape_string($conexion, $descripcion);
    $precio_p = mysqli_real_escape_string($conexion, $precio_p);
    $cantidad = mysqli_real_escape_string($conexion, $cantidad);
    
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO inventario (nombre_p, descripcion, precio, cantidad, imagen_p) VALUES ('$nombre_p', '$descripcion',
     '$precio_p', '$cantidad', '$archivo')";

    if (mysqli_query($conexion, $sql)) {
        $mensaje = "Registro exitoso. Nuevo producto agregado!";
        header("Location: inventario.php?mensaje=" . urlencode($mensaje));
        exit();
    } else {
        $mensaje = "Error al registrar!!.. " . mysqli_error($conexion);
        header("Location: invntario.php?mensaje=" . urlencode($mensaje));
        exit();
    }
    
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>