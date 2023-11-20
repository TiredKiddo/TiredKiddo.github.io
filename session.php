<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$nombreUsuario = $_SESSION['username'];
require_once "conexion.php";
$conexion = conectar();

if (session_status() == PHP_SESSION_NONE) {
    include("session.php");
}


if (!isset($_SESSION['username'])) {

    header("Location: login.php");
    exit;
}

$nombreUsuario = $_SESSION['username'];

?>