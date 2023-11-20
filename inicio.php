<?php
// Verificar si el usuario ha iniciado sesión
 include_once "session.php";
if (!isset($_SESSION['username'])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login_proceso.php"); 
    exit;
}
// Obtener el nombre del usuario desde la sesión
$nombreUsuario = $_SESSION['username']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 25px;
            text-align: left;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
       

    </style>
</head>
<body>

    <div class="sidebar">
    <?php 
$query = mysqli_query($conexion, "SELECT imagen FROM registro WHERE id=1");
$result = mysqli_num_rows($query);
if($result>0){
    while($data = mysqli_fetch_array($query)){
        ?>
        <img height= "50px" src="data:image/jpg;base64,  <?php echo base64_encode($data['imagen']) ?>">
        <?php echo $nombreUsuario; ?>   
    <?php
    }
}
?>

        <a href="inicio.php" >Inicio</a>
        <a href="inventario.php" target="programaIframe" >Inventario</a>
        <a href="stock_adm.php" target="programaIframe" >Stock</a>
        
    </div>

    <div class="content">
        
        <h1>Bienvenido a la página de administración</h1>

        <iframe src="" name="programaIframe" width="100%" height="610"></iframe>

    </div>
</body>
</html>