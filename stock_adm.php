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
            } else {
                echo "Error al actualizar el producto: " . mysqli_error($conexion);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Productos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        th, td {
            text-align: left;
            padding: 10px;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
    <script>
        function actualizarProducto(id, precio, cantidad) {
            fetch('actualizarp.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_producto=' + id + '&nuevo_precio=' + precio + '&nueva_cantidad=' + cantidad,
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al actualizar el producto');
                }
                return response.text();
            })
            .then(data => {
                alert(data); // Mostrar mensaje de éxito o error
            })
            .catch(error => {
                alert(error.message); // Mostrar mensaje de error
            });
        }
    </script>
</head>
<body>
<h2>Listado de Productos</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre del Producto</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Cantidad en Stock</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>

   <?php
   $query = mysqli_query($conexion, "SELECT * FROM inventario");
   $result = mysqli_num_rows($query);
   if($result>0){
       while($data = mysqli_fetch_array($query)){
           ?>
           <tr>
                <td><?php echo $data['id'] ?></td>
                <td><?php echo $data['nombre_p'] ?></td>
                <td><?php echo $data['descripcion'] ?></td>
                <td>
                    <!-- Formulario para actualizar el precio y la cantidad -->
                    <form onsubmit="actualizarProducto(<?php echo $data['id'] ?>, this.nuevo_precio.value, this.nueva_cantidad.value); return false;">
                        <input type="hidden" name="id_producto" value="<?php echo $data['id'] ?>">
                        Precio: <input type="text" name="nuevo_precio" value="<?php echo $data['precio'] ?>">
                        Cantidad: <input type="text" name="nueva_cantidad" value="<?php echo $data['cantidad'] ?>">
                        <input type="submit" value="Actualizar">
                    </form>
                </td>
                <td><?php echo $data['cantidad'] ?></td>
                <td><img height= "100px" src="data:image/jpg;base64,  <?php echo base64_encode($data['imagen_p']) ?>"></td>
                <td>
                    <form method="post" action="eliminarp.php"> 
                        <input type="hidden" name="id_producto" value="<?php echo $data['id'] ?>">
                        <input type="submit" value="Eliminar">
                    </form>
                </td>
           </tr>
       <?php
       }
   }
   ?>
</table>

<canvas id="myChart" width="120" height="40"></canvas>

<script>
   <?php
    $query = mysqli_query($conexion, "SELECT * FROM inventario");
    $result = mysqli_num_rows($query);
    $labels = [];
    $stock = [];
    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
            array_push($labels, $data['nombre_p']);
            array_push($stock, $data['cantidad']);
        }
    }
    ?>

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Cantidad en Stock',
                data: <?php echo json_encode($stock); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
