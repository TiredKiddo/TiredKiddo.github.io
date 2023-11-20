<?php
include("session.php"); 
?>

<!DOCTYPE html>
<html>
<head>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            margin: 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .producto {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            width: 30%;
            box-shadow: 0 4px 6px #ccc;
            transition: transform 0.2s;
        }

        .producto:hover {
            transform: scale(1.02);
        }

        .producto h2 {
            font-size: 18px;
            margin: 10px 0;
            text-align: center;
        }

        .producto p {
            font-size: 14px;
            text-align: center;
        }

        .producto img {
            max-width: 100%;
            display: block;
            margin: 0 auto;
        }

        .add-to-cart {
            text-align: center;
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #83bb75;
        }
    </style>
</head>

<body>
    <h1>Catálogo de Productos</h1>

    <div class="container">
        <?php
        $sql = "SELECT * FROM inventario";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='producto'>";
                echo "<h2>" . $row['nombre_p'] . "</h2>";
                echo "<p>" . $row['descripcion'] . "</p>";
                echo "<p>Precio: $" . $row['precio'] . "</p>";
                echo "<p>Cantidad: " . $row['cantidad'] . "</p>";
                echo "<img height='210px' src='data:image/jpg;base64, " . base64_encode($row['imagen_p']) . "'>";
                echo "<div class='add-to-cart'>";
                echo '<form action="carrito.php" method="POST">';
                echo '<input type="hidden" name="producto_id" value="' . $row['id'] . '">';
                echo '<label for="cantidad">Cantidad:</label>';
                echo '<input type="number" name="cantidad" min="1" value="1">';
                echo '<input type="submit" value="Agregar al carrito">';
                echo '</form>';
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No se encontraron productos en el catálogo.";
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
        ?>
    </div>
</body>
</html>
