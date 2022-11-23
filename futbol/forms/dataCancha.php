<?php
session_start();
include("../classes/connect.php");

if (isset($_POST['accion']) && $_POST['accion'] == 'consultar') {
    $resultado = $mysqli->query("SELECT Nombre_Cancha, Direccion, Telefono, Comentario FROM cancha WHERE Id_Cancha = '" . $_POST['CanchaId'] . "'");
    $registro = $resultado->fetch_array(MYSQLI_ASSOC);
    echo json_encode($registro);
    return;
}

if (isset($_POST['accion']) && $_POST['accion'] == 'guardar') {
    if (isset($_POST['NuevoRegistro']) && $_POST['NuevoRegistro'] == '1') {
        $mysqli->query("INSERT INTO cancha (Nombre_Cancha, Direccion, Telefono, Comentario) VALUES ('" . $_POST['CanchaName'] . "','" . $_POST['direccion'] . "','" . $_POST['telefono'] . "','" . $_POST['comentarioName'] . "')");
        $CanchaId = $mysqli->insert_id;
    } else {
        $mysqli->query("UPDATE cancha SET Nombre_Cancha = '" . $_POST['CanchaName'] . "',  Direccion = '" . $_POST['direccion'] . "', Telefono = '" . $_POST['telefono'] . "', Comentario = '" . $_POST['comentarioName'] . "' WHERE 	Id_Cancha = '" . $_POST['CanchaId'] . "'");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $mysqli->query("DELETE FROM cancha WHERE Id_Cancha = '" . $_POST['CanchaId'] . "'");
}

$resultado = $mysqli->query("SELECT Id_Cancha, Nombre_Cancha, Direccion, Telefono, Comentario FROM cancha");

echo "<div class='container text-center mt-5'>";
echo "<table class='table'>";
if ($_SESSION['Perfil']=='admin') echo "<thead><tr><th colspan='7'><button id='Agregar' type='button' class='btcs btn btn-sm btn-outline-secondary'>Agregar Cancha</button></th></tr></thead>";
echo "<thead class='ebc'><tr><th>Nombre Cancha</th><th>Direccion</th><th>Telefono</th><th>Comentario</th>";
if ($_SESSION['Perfil']=='admin') echo "<th>Aciones</th>";
echo "</tr></thead>";
echo "<tbody>";

while ($registro = $resultado->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . $registro["Nombre_Cancha"] . "</td>";
    echo "<td>" . $registro["Direccion"] . "</td>";
    echo "<td>" . $registro["Telefono"] . "</td>";
    echo "<td>" . $registro["Comentario"] . "</td>";
    if ($_SESSION['Perfil']=='admin') {
        echo "<td>";    
        echo "<div class='btn-group'>";
        echo "<button id='divEditar" . $registro["Id_Cancha"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/editar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "<button id='divEliminar" . $registro["Id_Cancha"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/borrar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "</div>";
        echo "</td>";
    }
    echo "</tr>";
}

echo "</tbody></table></div>";
