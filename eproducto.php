<?php
    include("session.php");

    if (isset($_POST['indice'])) {
        $indice = $_POST['indice'];
        if (isset($_SESSION['carrito'][$indice])) {
            unset($_SESSION['carrito'][$indice]);
        }
    }

    header("Location: carrito.php");
?>
