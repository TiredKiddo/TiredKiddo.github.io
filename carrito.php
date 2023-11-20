<?php
include("session.php");
?>

<?php


if (isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad_seleccionada = $_POST['cantidad'];

    // Realiza una consulta para obtener los detalles del producto
    $sql = "SELECT nombre_p, precio, imagen_p, cantidad FROM inventario WHERE id = $producto_id";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica si la cantidad seleccionada por el usuario no excede la cantidad disponible en stock
        if ($cantidad_seleccionada <= $row['cantidad']) {
            // Almacena la información del producto en la sesión (carrito)
            $producto = array(
                'nombre' => $row['nombre_p'],
                'precio' => $row['precio'],
                'imagen' => $row['imagen_p'],
                'cantidad' => $cantidad_seleccionada, // Usar la cantidad seleccionada por el usuario
            );

            $_SESSION['carrito'][] = $producto;

            // Actualizar el stock en la base de datos
            $cantidad_actual = $row['cantidad']; // Obtener la cantidad actual
            $nueva_cantidad = $cantidad_actual - $cantidad_seleccionada; // Restar la cantidad seleccionada al stock actual
            $update_sql = "UPDATE inventario SET cantidad = $nueva_cantidad WHERE id = $producto_id";
            $conexion->query($update_sql);
        } else {
            // Mostrar un mensaje si la cantidad seleccionada excede la cantidad en stock
            echo "La cantidad seleccionada excede la cantidad disponible en stock.";
        }
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
        .carrito-container {
            margin-top: 20px;
        }

        .delete-button {
            background-color: #ff0000;
            color: #ffffff;
            border: none;
            padding: 5px 20px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #83bb75;
        }

        .pay-button {
            background-color: #75bb99;
            color: #ffffff;
            border: none;
            padding: 5px 25px;
            cursor: pointer;
        }

        .pay-button:hover {
            background-color: #83bb75;
        }
    </style>
</head>
<body>
    <h1>Carrito de Compras</h1>

    <?php
    // Mostrar los productos en el carrito
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        echo "<table>";
        echo "<tr><th>Producto</th>
        <th>Precio</th>
        <th>Imagen</th>
        <th>Quitar Producto</th>
        <th>Cantidad</th>
        </tr>";
        
        $total = 0; // Inicializamos la variable total
        
        foreach ($_SESSION['carrito'] as $clave => $producto) {
            echo "<tr>";
            echo "<td>" . $producto['nombre'] . "</td>";
            echo "<td>$" . $producto['precio'] . "</td>";
            echo "<td><img src='data:image/jpg;base64, " . base64_encode($producto['imagen']) . "'></td>";
            
            echo "<td><form method='post' action='eproducto.php'>";
            echo "<input type='hidden' name='indice' value='$clave'>";
            echo "<button type='submit' class='delete-button'>Eliminar</button>";
            echo "</form></td>";

            echo "<td>" . $producto['cantidad'] . "</td>";
            
            echo "</tr>";

            // Sumar el precio del producto al total
            $total += $producto['precio'] * $producto['cantidad'];
        }
        
        // Mostramos el total y el botón de "Pagar"
        echo "<tr>";
        echo "<td><strong>Total:</strong></td>";
        echo "<td><strong>$" . $total . "</strong></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "</tr>";
        
        echo "</table>";

        // Botón de pago
        echo "<form method='post' action='pagar.php'>"; 
        echo "<button type='submit' class='pay-button'>Pagar</button>";
        echo "</form>";
    } else {
        echo "El carrito está vacío.";
    }
    ?>
</body>
</html>
