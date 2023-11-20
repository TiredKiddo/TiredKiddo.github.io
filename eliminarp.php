<?php
include("session.php");


if(isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    
    $query = "DELETE FROM inventario WHERE id = $id_producto";

    if(mysqli_query($conexion, $query)) {
        echo "Producto eliminado correctamente.";
    } else {
        echo "Error al eliminar el producto: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
