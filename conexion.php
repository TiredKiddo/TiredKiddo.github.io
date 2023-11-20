<?php
function conectar(){
    $user = "Tiredkiddo";
    $pass = "291813Br!";
    $server = "localhost";
    $db = "ventaa";
    
    $con = mysqli_connect($server, $user, $pass, $db);

    if (!$con) {
        die("No hay conexión a la base de datos: " . mysqli_connect_error());
    }

    return $con;
}
?>
