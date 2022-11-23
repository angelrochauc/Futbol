<?php
session_start();
include("../classes/connect.php");

if (isset($_POST['accion']) && $_POST['accion'] == 'consultar') {
    $resultado = $mysqli->query("SELECT Nombre_Torneo, Fecha_Inicio, Fecha_Fin, Comentario FROM torneo WHERE Id_Torneo = '" . $_POST['TorneoId'] . "'");
    $registro = $resultado->fetch_array(MYSQLI_ASSOC);
    echo json_encode($registro);
    return;
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarCxT') {
    $resultado = $mysqli->query("SELECT c.Id_Cancha, t.Id_Torneo FROM torneo_cancha tc LEFT JOIN cancha c ON tc.Id_Cancha = c.Id_Cancha LEFT JOIN torneo t ON tc.Id_Torneo = t.Id_Torneo WHERE t.Id_Torneo = '" . $_POST['TorneoId'] . "'");
    $results = array();
    while ($registro = $resultado->fetch_array()) {
        $results[] = array(
            'id_cancha' => $registro['Id_Cancha'],
            'id_torneo' => $registro['Id_Torneo']
        );
    }
    echo json_encode($results);
    return;
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarExT') {
    $resultado = $mysqli->query("SELECT e.Id_Equipo, t.Id_Torneo FROM equipo_torneo et LEFT JOIN equipo e ON et.Id_Equipo = e.Id_Equipo LEFT JOIN torneo t ON et.Id_Torneo = t.Id_Torneo WHERE t.Id_Torneo = '" . $_POST['TorneoId'] . "'");
    $results = array();
    while ($registro = $resultado->fetch_array()) {
        $results[] = array(
            'id_equipo' => $registro['Id_Equipo'],
            'id_torneo' => $registro['Id_Torneo']
        );
    }
    echo json_encode($results);
    return;
}

if (isset($_POST['accion']) && $_POST['accion'] == 'guardar') {
    if (isset($_POST['NuevoRegistro']) && $_POST['NuevoRegistro'] == '1') {
        $mysqli->query("INSERT INTO torneo (Nombre_Torneo, Fecha_Inicio, Fecha_Fin, Comentario) VALUES ('" . $_POST['TorneoName'] . "','" . $_POST['FechaIni'] . "','" . $_POST['FechaFin'] . "','" . $_POST['comentarioName'] . "')");
        $TorneoId = $mysqli->insert_id;
        for ($i = 0; $i < count($_POST['Canchas']); $i++) {
            $mysqli->query("INSERT INTO torneo_cancha (Id_Cancha, Id_Torneo) VALUES ('" . $_POST['Canchas'][$i] . "','" . $TorneoId . "')");
        }
        for ($i = 0; $i < count($_POST['Equipos']); $i++) {
            $mysqli->query("INSERT INTO equipo_torneo (Id_Equipo, Id_Torneo) VALUES ('" . $_POST['Equipos'][$i] . "','" . $TorneoId . "')");
        }
        generarPartidosTorneo($TorneoId);
    } else {
        $mysqli->query("UPDATE torneo SET Nombre_Torneo = '" . $_POST['TorneoName'] . "',  Fecha_Inicio = CAST('" . $_POST['FechaIni'] . "' AS DATE), Fecha_Fin = CAST('" . $_POST['FechaFin'] . "' AS DATE), Comentario = '" . $_POST['comentarioName'] . "' WHERE Id_Torneo = '" . $_POST['TorneoId'] . "'");
        for ($i = 0; $i < count($_POST['Canchas']); $i++) {
            $res_tc = $mysqli->query("SELECT * FROM torneo_cancha WHERE Id_Cancha = '" . $_POST['Canchas'][$i] . "' AND Id_Torneo = '" . $_POST['TorneoId'] . "'");
            if (mysqli_num_rows($res_tc) == 0) {
                $mysqli->query("INSERT INTO torneo_cancha (Id_Cancha, Id_Torneo) VALUES ('" . $_POST['Canchas'][$i] . "','" . $_POST['TorneoId'] . "')");
            }
        }
        for ($i = 0; $i < count($_POST['Equipos']); $i++) {
            $res_et = $mysqli->query("SELECT * FROM equipo_torneo WHERE Id_Equipo = '" . $_POST['Equipos'][$i] . "' AND Id_Torneo = '" . $_POST['TorneoId'] . "'");
            if (mysqli_num_rows($res_et) == 0) {
                $mysqli->query("INSERT INTO equipo_torneo (Id_Equipo, Id_Torneo) VALUES ('" . $_POST['Equipos'][$i] . "','" . $_POST['TorneoId'] . "')");
            }
        }
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $mysqli->query("DELETE FROM torneo WHERE Id_Torneo = '" . $_POST['TorneoId'] . "'");
}

$resultado = $mysqli->query("SELECT Id_Torneo, Nombre_Torneo, Fecha_Inicio, Fecha_Fin, Comentario FROM torneo");

echo "<div class='container text-center mt-5'>";
echo "<table class='table'>";
if ($_SESSION['Perfil']=='admin') echo "<thead><tr><th colspan='7'><button id='Agregar' type='button' class='btcs btn btn-sm btn-outline-secondary'>Agregar Torneo</button></th></tr></thead>";
echo "<thead class='ebc'><tr><th>Nombre Torneo</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Comentario</th>";
echo "<th>Aciones</th>";
echo "</tr></thead>";
echo "<tbody>";

while ($registro = $resultado->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . $registro["Nombre_Torneo"] . "</td>";
    echo "<td>" . $registro["Fecha_Inicio"] . "</td>";
    echo "<td>" . $registro["Fecha_Fin"] . "</td>";
    echo "<td>" . $registro["Comentario"] . "</td>";
    if ($_SESSION['Perfil'] == 'admin') {
        echo "<td>";
        echo "<div class='btn-group'>";
        echo "<button id='divEditar" . $registro["Id_Torneo"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/editar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "<button id='divEliminar" . $registro["Id_Torneo"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/borrar.svg'><span class='visually-hidden'>Button</span></button>";
        echo "<button id='divDetalles" . $registro["Id_Torneo"] . "' type='button' class='btn btn-sm btn-outline-secondary' onclick='window.location.href = \"f_torneo_detalles.php?torneo=" . $registro["Id_Torneo"] . "\"'><img src='../img/detalles.svg'><span class='visually-hidden'>Button</span></button>";
        echo "</div>";
        echo "</td>";
    }
    else {
        echo "<td>";
        echo "<div class='btn-group'>";
        echo "<button id='divDetalles" . $registro["Id_Torneo"] . "' type='button' class='btn btn-sm btn-outline-secondary' onclick='window.location.href = \"f_torneo_detalles.php?torneo=" . $registro["Id_Torneo"] . "\"'><img src='../img/detalles.svg'><span class='visually-hidden'>Button</span></button>";
        echo "</div>";
        echo "</td>";
    }
    echo "</tr>";
}

echo "</tbody></table></div>";

function generarPartidosTorneo($torneo)
{
    include("../classes/connect.php");

    $r_torneo = $mysqli->query("SELECT Nombre_Torneo, Fecha_Inicio, Fecha_Fin FROM torneo WHERE Id_Torneo = '" . $torneo . "';");
    $datosTorneo = $r_torneo->fetch_array();

    $start = new DateTime($datosTorneo['Fecha_Inicio'] . ' 08:00:00');
    $end   = new DateTime($datosTorneo['Fecha_Fin'] . ' 18:00:00');
    $interval = new DateInterval('PT4H');

    $period = new DatePeriod($start, $interval, $end);

    foreach ($period as $date) {
        $hour = $date->format('H');
        if ($hour == '00' || $hour == '02' || $hour == '04' || $hour == '06' || $hour == '20' || $hour == '22') continue;
        else $fechasDisponibles[] = $date->format('Y-m-d H:i:s');
    }

    $r_canchas = $mysqli->query("SELECT tc.Id_Torneo_Cancha, c.Nombre_Cancha FROM torneo t LEFT JOIN torneo_cancha tc ON t.Id_Torneo = tc.Id_Torneo LEFT JOIN cancha c ON tc.Id_Cancha = c.Id_Cancha WHERE t.Id_Torneo = '" . $torneo . "';");
    while ($row = $r_canchas->fetch_array()) {
        $canchas[] = $row;
    }

    $r_equipos = $mysqli->query("SELECT ROW_NUMBER() OVER(PARTITION BY t.Id_Torneo) as eId, e.Id_Equipo, Nombre_Equipo FROM torneo t LEFT JOIN equipo_torneo et ON t.Id_Torneo = et.Id_Torneo LEFT JOIN equipo e ON et.Id_Equipo = e.Id_Equipo WHERE t.Id_Torneo = '" . $torneo . "';");

    $i = 0;
    while ($equipos = $r_equipos->fetch_array()) {
        $r = rand(0,count($canchas));          
        if ($i % 2 == 0) {
            $fechahora = $fechasDisponibles[$i];   
            $cancha = $canchas[$r][0];
            $local = $equipos['Id_Equipo'];
        } else {
            $visitante = $equipos['Id_Equipo'];
            $mysqli->query("INSERT INTO partido (Fecha_Hora, Id_Equipo_Local, Id_Equipo_Visitante, Id_Torneo_Cancha) VALUES ('" . $fechahora . "','" . $local . "','" . $visitante . "','" . $cancha . "')");
        }
        $i++;
    }
}