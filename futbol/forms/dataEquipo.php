<?php
session_start();
include("../classes/connect.php");

if (isset($_POST['accion']) && $_POST['accion'] == 'consultar') {
    $resultado = $mysqli->query("SELECT Nombre_Equipo, Comentario FROM equipo WHERE Id_Equipo = '" . $_POST['EquipoId'] . "'");
    $registro = $resultado->fetch_array(MYSQLI_ASSOC);
    echo json_encode($registro);
    return;
}

if (isset($_POST['accion']) && $_POST['accion'] == 'guardar') {
    if (isset($_POST['NuevoRegistro']) && $_POST['NuevoRegistro'] == '1') {
        $mysqli->query("INSERT INTO equipo (Nombre_Equipo, Comentario) VALUES ('" . $_POST['equipoName'] . "','" . $_POST['Comentario'] . "')");
        $EquipoId = $mysqli->insert_id;
    } else {
        $mysqli->query("UPDATE equipo SET Nombre_Equipo = '" . $_POST['equipoName'] . "',  Comentario = '" . $_POST['Comentario'] . "' WHERE 	Id_Equipo = '" . $_POST['EquipoId'] . "'");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $mysqli->query("DELETE FROM equipo WHERE Id_Equipo = '" . $_POST['EquipoId'] . "'");
}

$resultado = $mysqli->query("SELECT Id_Equipo, Nombre_Equipo, Comentario FROM equipo");

echo "<div class='container text-center mt-5'>";
echo "<table class='table'>";
if ($_SESSION['Perfil']=='admin') echo "<thead><tr><th colspan='7'><button id='Agregar' type='button' class='btcs btn btn-sm btn-outline-secondary'>Agregar Equipo</button></th></tr></thead>";
echo "<thead class='ebc'><tr><th>Nombre Equipo</th><th>Comentario</th>";
if ($_SESSION['Perfil']=='admin') echo "<th>Aciones</th>";
echo "</tr></thead>";
echo "<tbody>";

while ($registro = $resultado->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . $registro["Nombre_Equipo"] . "</td>";
    echo "<td>" . $registro["Comentario"] . "</td>";
    if ($_SESSION['Perfil']=='admin') {
        echo "<td>";    
        echo "<div class='btn-group'>";
        echo "<button id='divEditar" . $registro["Id_Equipo"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/editar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "<button id='divEliminar" . $registro["Id_Equipo"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/borrar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "</div>";
        echo "</td>";
    }
    echo "</tr>";
}

echo "</tbody></table></div>";
