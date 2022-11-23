<?php
session_start();
include("../classes/connect.php");

if (isset($_POST['accion']) && $_POST['accion'] == 'consultar') {
    $resultado = $mysqli->query("SELECT Id_Usuario, Nombre_Usuario, cedula, password, Perfil FROM usuario WHERE Id_Usuario = '" . $_POST['usuarioId'] . "'");
    $registro = $resultado->fetch_array(MYSQLI_ASSOC);
    echo json_encode($registro);
    return;
}

if (isset($_POST['accion']) && $_POST['accion'] == 'guardar') {
    if (isset($_POST['NuevoRegistro']) && $_POST['NuevoRegistro'] == '1') {
        $mysqli->query("INSERT INTO usuario (Nombre_Usuario, password, cedula, perfil) VALUES ('" . $_POST['usuarioName'] . "','" . $_POST['password'] . "','" . $_POST['cedula'] . "','" . $_POST['perfil'] . "')");
        $UsuarioId = $mysqli->insert_id;
    } else {
        $mysqli->query("UPDATE usuario SET Nombre_Usuario = '" . $_POST['usuarioName'] . "', perfil = '" . $_POST['perfil'] . "',  password = '" . $_POST['password'] . "', cedula = '" . $_POST['cedula'] . "' WHERE 	Id_Usuario = '" . $_POST['usuarioId'] . "'");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $mysqli->query("DELETE FROM usuario WHERE Id_Usuario = '" . $_POST['usuarioId'] . "'");
}

$resultado = $mysqli->query("SELECT Id_Usuario, Nombre_Usuario, cedula, password, perfil FROM usuario");

echo "<div class='container text-center mt-5'>";
echo "<table class='table'>";
if ($_SESSION['Perfil']=='admin') echo "<thead><tr><th colspan='7'><button id='Agregar' type='button' class='btcs btn btn-sm btn-outline-secondary'>Agregar Usuario</button></th></tr></thead>";
echo "<thead class='ebc'><tr><th>Nombre</th><th>Cedula</th><th>Contraseña</th><th>Perfil</th>";
if ($_SESSION['Perfil']=='admin') echo "<th>Aciones</th>";
echo "</tr></thead>";
echo "<tbody>";

while ($registro = $resultado->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . $registro["Nombre_Usuario"] . "</td>";
    echo "<td>" . $registro["cedula"] . "</td>";
    echo "<td>" . $registro["password"] . "</td>";
    echo "<td>" . $registro["perfil"] . "</td>";
    if ($_SESSION['Perfil']=='admin') {
        echo "<td>";    
        echo "<div class='btn-group'>";
        echo "<button id='divEditar" . $registro["Id_Usuario"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/editar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "<button id='divEliminar" . $registro["Id_Usuario"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/borrar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "</div>";
        echo "</td>";
    }
    echo "</tr>";
}

echo "</tbody></table></div>";
