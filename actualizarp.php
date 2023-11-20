<?php
include("session.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_producto'])) {
        $id_producto = $_POST['id_producto']; // Obtén el ID del producto desde el formulario

        // Verifica si se han enviado los datos de cantidad y precio desde el formulario de actualización
        if (isset($_POST['nuevo_precio']) && isset($_POST['nueva_cantidad'])) {
            $nuevo_precio = $_POST['nuevo_precio'];
            $nueva_cantidad = $_POST['nueva_cantidad'];

            // Actualiza la cantidad y el precio del producto en la base de datos
            $query = "UPDATE inventario SET precio = '$nuevo_precio', cantidad = '$nueva_cantidad' WHERE id = $id_producto";

            if (mysqli_query($conexion, $query)) {
                echo "Producto actualizado correctamente";
                echo "Error al actualizar el producto: " . mysqli_error($conexion);
            }
        }
    }
}
?>