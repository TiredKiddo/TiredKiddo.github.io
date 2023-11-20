<?php
include("session.php");


if(isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $nombre_p = $_POST['nombre_p'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Realiza una consulta SQL para actualizar la información del producto
    $query = "UPDATE inventario SET nombre_p = '$nombre_p', descripcion = '$descripcion', precio = '$precio' WHERE id = $id_producto";

    if(mysqli_query($conexion, $query)) {
        echo "Producto actualizado correctamente.";
    } else {
        echo "Error al actualizar el producto: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
