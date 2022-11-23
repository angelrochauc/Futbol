<?php
session_start();
include("../classes/connect.php");

if (isset($_POST['accion']) && $_POST['accion'] == 'consultar') {
    $resultado = $mysqli->query("SELECT Nombre_Apellido, Id_Posicion_Jugador, je.Id_Equipo FROM jugador j LEFT JOIN jugador_equipo je ON j.Id_Jugador = je.Id_Jugador WHERE j.Id_Jugador = '" . $_POST['JugadorId'] . "'");
    $registro = $resultado->fetch_array(MYSQLI_ASSOC);
    echo json_encode($registro);
    return;
}

if (isset($_POST['accion']) && $_POST['accion'] == 'guardar') {
    if (isset($_POST['NuevoRegistro']) && $_POST['NuevoRegistro'] == '1') {
        $mysqli->query("INSERT INTO jugador (Nombre_Apellido,  Id_Posicion_Jugador) VALUES ('" . $_POST['jugadorName'] . "','" . $_POST['posicion'] . "')");
        $JugadorId = $mysqli->insert_id;
        $mysqli->query("INSERT INTO jugador_equipo (Id_Equipo,  Id_Jugador) VALUES ('" . $_POST['equipo'] . "','" . $JugadorId . "')");        
    } else {
        $mysqli->query("UPDATE jugador SET Nombre_Apellido = '" . $_POST['jugadorName'] . "', Id_Posicion_Jugador = '" . $_POST['posicion'] . "' WHERE Id_Jugador = '" . $_POST['JugadorId'] . "'");
        
        $res = $mysqli->query("SELECT * FROM jugador_equipo WHERE Id_Equipo = '" . $_POST['equipo'] . "' AND Id_Equipo = '" . $_POST['JugadorId'] . "'");
        if (mysqli_num_rows($res) == 0) {
            $mysqli->query("INSERT INTO jugador_equipo (Id_Equipo, Id_Jugador) VALUES ('" . $_POST['equipo'] . "','" . $_POST['JugadorId'] . "')");
        }else{
            $mysqli->query("UPDATE jugador_equipo SET Id_Equipo = '" . $_POST['equipo'] . "' WHERE Id_Jugador = '" . $_POST['JugadorId'] . "'");
        }
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $mysqli->query("DELETE FROM jugador WHERE Id_Jugador = '" . $_POST['JugadorId'] . "'");
}

//Listado Completo
$resultado = $mysqli->query("SELECT j.Id_Jugador, Nombre_Apellido, pj.Descripcion Posicion, e.Nombre_Equipo FROM jugador j LEFT JOIN jugador_equipo je ON j.Id_Jugador = je.Id_Jugador LEFT JOIN equipo e ON je.Id_Equipo = e.Id_Equipo LEFT JOIN posicion_jugador pj ON j.Id_Posicion_Jugador = pj.Id_Posicion_Jugador");

echo "<div class='container text-center mt-5'>";
echo "<table class='table'>";
if ($_SESSION['Perfil']=='admin') echo "<thead><tr><th colspan='4'><button id='Agregar' type='button' class='btcs btn btn-sm btn-outline-secondary'>Agregar Jugador</button></th></tr></thead>";
echo "<thead class='ebc'><tr><th>Nombre y Apellido</th><th>Equipo</th><th>Posicion</th>";
if ($_SESSION['Perfil']=='admin') echo "<th>Aciones</th>";
echo "</tr></thead>";
echo "<tbody>";

while ($registro = $resultado->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . $registro["Nombre_Apellido"] . "</td>";
    echo "<td>" . $registro["Nombre_Equipo"] . "</td>";
    echo "<td>" . $registro["Posicion"] . "</td>";
    if ($_SESSION['Perfil']=='admin') {
        echo "<td>";    
        echo "<div class='btn-group'>";
        echo "<button id='divEditar" . $registro["Id_Jugador"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/editar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "<button id='divEliminar" . $registro["Id_Jugador"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/borrar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "</div>";
        echo "</td>";
    }
    echo "</tr>";
}

echo "</tbody></table></div>";
