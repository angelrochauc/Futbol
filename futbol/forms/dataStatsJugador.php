<?php
session_start();
include("../classes/connect.php");

if (isset($_POST['accion']) && $_POST['accion'] == 'consultar') {
    $resultado = $mysqli->query("SELECT s.Id_Stas_Jugador_Torneo, j.Nombre_Apellido, t.Nombre_Torneo, s.Cantidad_Goles FROM stats_jugador_torneo s LEFT JOIN torneo t ON s.Id_Torneo = t.Id_Torneo LEFT JOIN jugador j ON s.Id_Jugador = j.Id_Jugador WHERE j.Id_Jugador = '" . $_POST['jugador'] . "'");
    $registro = $resultado->fetch_array(MYSQLI_ASSOC);
    echo json_encode($registro);
    return;
}

if (isset($_POST['accion']) && $_POST['accion'] == 'guardar') {
    if (isset($_POST['NuevoRegistro']) && $_POST['NuevoRegistro'] == '1') {
        $mysqli->query("INSERT INTO stats_jugador_torneo (Id_Jugador,  Id_Torneo, Cantidad_Goles) VALUES ('" . $_POST['jugador'] . "','" . $_POST['torneo'] . "','" . $_POST['goles'] . "')");
    } else {
        $mysqli->query("UPDATE stats_jugador_torneo SET Cantidad_Goles = '" . $_POST['goles'] . "' WHERE Id_Jugador = '" . $_POST['jugador'] . "' AND Id_Torneo = '" . $_POST['torneo'] . "'");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $mysqli->query("DELETE FROM stats_jugador_torneo WHERE Id_Jugador = '" . $_POST['jugador'] . "' AND Id_Torneo = '" . $_POST['torneo'] . "'");
}

//Listado Completo
if (isset($_POST['porTorneo']) && $_POST['porTorneo'] == '1') {
    $resultado = $mysqli->query("SELECT s.Id_Stas_Jugador_Torneo, j.Nombre_Apellido, t.Nombre_Torneo, s.Cantidad_Goles FROM stats_jugador_torneo s LEFT JOIN torneo t ON s.Id_Torneo = t.Id_Torneo LEFT JOIN jugador j ON s.Id_Jugador = j.Id_Jugador WHERE t.Id_Torneo = '" . $_POST['torneo'] . "' ORDER BY 4 DESC;");
}else{
    $resultado = $mysqli->query("SELECT s.Id_Stas_Jugador_Torneo, j.Nombre_Apellido, t.Nombre_Torneo, s.Cantidad_Goles FROM stats_jugador_torneo s LEFT JOIN torneo t ON s.Id_Torneo = t.Id_Torneo LEFT JOIN jugador j ON s.Id_Jugador = j.Id_Jugador ORDER BY 4 DESC;");
}

echo "<div class='container text-center mt-5'>";
echo "<table class='table'>";
if ($_SESSION['Perfil']=='admin') echo "<thead><tr><th colspan='4'><button id='Agregar' type='button' class='btcs btn btn-sm btn-outline-secondary'>Agregar Goles a Jugador</button></th></tr></thead>";
echo "<thead class='ebc'><tr><th>Nombre y Apellido</th><th>Torneo</th><th>Goles</th>";
if ($_SESSION['Perfil']=='admin') echo "<th>Aciones</th>";
echo "</tr></thead>";
echo "<tbody>";

while ($registro = $resultado->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . $registro["Nombre_Apellido"] . "</td>";
    echo "<td>" . $registro["Nombre_Torneo"] . "</td>";
    echo "<td>" . $registro["Cantidad_Goles"] . "</td>";
    if ($_SESSION['Perfil']=='admin') {
        echo "<td>";    
        echo "<div class='btn-group'>";
        echo "<button id='divEditar" . $registro["Id_Stas_Jugador_Torneo"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/editar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "<button id='divEliminar" . $registro["Id_Stas_Jugador_Torneo"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/borrar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "</div>";
        echo "</td>";
    }
    echo "</tr>";
}

echo "</tbody></table></div>";
