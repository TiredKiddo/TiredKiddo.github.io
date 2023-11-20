<?php
    include("session.php");

    // aproducto.php
$indice = $_POST['indice'];
$cantidad = $_POST['cantidad'][$indice]; // Asegúrate de obtener la cantidad del formulario

if (isset($_SESSION['carrito'][$indice])) {
    $_SESSION['carrito'][$indice]['cantidad'] += $cantidad;
} else {
    $_SESSION['carrito'][$indice]['cantidad'] = $cantidad;
}


    header("Location: carrito.php"); // Redirecciona de nuevo a la página del carrito
?>
