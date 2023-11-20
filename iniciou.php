
<?php

include('session.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="inicioU.css">
    <meta charset="UTF-8">


</head>

<body>

    <div class="sidebar">
        <?php
        $query = mysqli_query($conexion, "SELECT imagen FROM registro WHERE id=1");
        $result = mysqli_num_rows($query);
        if ($result > 0) {
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <img height="50px" src="data:image/jpg;base64,  <?php echo base64_encode($data['imagen']) ?>">
                <?php echo $nombreUsuario; ?>
                <?php
            }
        }
        ?>


        <a href="iniciou.php">Inicio </a>
        <a href="productos.php" target="programaIframe">Productos</a>
        <a href="carrito.php" target="programaIframe">Carrito</a>
        <a href="objeto3D.php" target="programaIframe">Objeto 3D</a>
    </div>

    <div class="content">

        <h1>Bienvenido a KiddoSound</h1>

        <iframe src="" name="programaIframe" width="100%" height="610"> </iframe>



    </div>


</body>

</html>