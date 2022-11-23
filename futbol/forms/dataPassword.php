<?php
session_start();
include("../classes/connect.php");

if (isset($_POST['accion']) && $_POST['accion'] == 'guardar') {
    $mysqli->query("CALL cambioPassword ('" . $_POST['NombreUsuario'] . "', '" . $_POST['Password'] . "');");
}

