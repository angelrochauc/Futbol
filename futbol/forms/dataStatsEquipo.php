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
        $res = $mysqli->query("SELECT Id_Equipo_Torneo FROM equipo_torneo WHERE Id_Equipo = '".$_POST['equipo']."' AND Id_Torneo = '".$_POST['torneo']."' LIMIT 1;");
        $idET = $res->fetch_row()[0] ?? false;        
        $mysqli->query("INSERT INTO stats_equipo_torneo (Posicion_Torneo, Puntos, Partidos_Jugados, Partidos_Ganados, Partidos_Perdidos, Partidos_Empatados, Goles_Afavor, Goles_Encontra, Tarjetas_Amarillas, Tarjetas_Rojas, Id_Equipo_Torneo) VALUES ('" . $_POST['posicion'] . "', '" . $_POST['puntos'] . "', '" . $_POST['PJ'] . "', '" . $_POST['PG'] . "', '" . $_POST['PP'] . "', '" . $_POST['PE'] . "', '" . $_POST['GF'] . "', '" . $_POST['GC'] . "', '" . $_POST['TA'] . "', '" . $_POST['TR'] . "', '" . $idET . "')");
        $EquipoId = $mysqli->insert_id;
    } else {
        $mysqli->query("UPDATE equipo SET Nombre_Equipo = '" . $_POST['equipoName'] . "',  Comentario = '" . $_POST['Comentario'] . "' WHERE 	Id_Equipo = '" . $_POST['EquipoId'] . "'");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $mysqli->query("DELETE FROM equipo WHERE Id_Equipo = '" . $_POST['EquipoId'] . "'");
}

if (isset($_POST['torneo'])) {
    $resultado = $mysqli->query("SELECT t.Nombre_Torneo, e.Nombre_Equipo, ste.Posicion_Torneo, ste.Puntos, ste.Partidos_Jugados, ste.Partidos_Ganados, ste.Partidos_Perdidos, ste.Partidos_Empatados, ste.Goles_Afavor, ste.Goles_Encontra, ste.Tarjetas_Amarillas, ste.Tarjetas_Rojas FROM stats_equipo_torneo ste LEFT JOIN equipo_torneo et ON ste.Id_Equipo_Torneo = et.Id_Equipo_Torneo LEFT JOIN equipo e ON et.Id_Equipo = e.Id_Equipo LEFT JOIN torneo t ON et.Id_Torneo = t.Id_Torneo WHERE t.Id_Torneo = '" . $_POST['torneo'] . "' ORDER BY 3;");

    echo "<div class='container text-center mt-5'>";
    echo "<table class='table'>";
    if ($_SESSION['Perfil']=='admin') echo "<thead><tr><th colspan='11'><button id='Agregar' type='button' class='btcs btn btn-sm btn-outline-secondary'>Agregar Estadisticas al Torneo</button></th></tr></thead>";
    echo "<thead class='ebc'><tr><th>Nombre Equipo</th><th>Posicion</th><th>Puntos</th><th>PJ</th><th>PG</th><th>PP</th><th>PE</th><th>GF</th><th>GC</th><th>TA</th><th>TR</th>";
    // if ($_SESSION['Perfil']=='admin') echo "<th>Aciones</th>";
    echo "</tr></thead>";
    echo "<tbody>";

    while ($registro = $resultado->fetch_array()) {
        echo "<tr class='table-light'>";
        echo "<td>" . $registro["Nombre_Equipo"] . "</td>";
        echo "<td>" . $registro["Posicion_Torneo"] . "</td>";
        echo "<td>" . $registro["Puntos"] . "</td>";
        echo "<td>" . $registro["Partidos_Jugados"] . "</td>";
        echo "<td>" . $registro["Partidos_Ganados"] . "</td>";
        echo "<td>" . $registro["Partidos_Perdidos"] . "</td>";
        echo "<td>" . $registro["Partidos_Empatados"] . "</td>";
        echo "<td>" . $registro["Goles_Afavor"] . "</td>";
        echo "<td>" . $registro["Goles_Encontra"] . "</td>";
        echo "<td>" . $registro["Tarjetas_Amarillas"] . "</td>";
        echo "<td>" . $registro["Tarjetas_Rojas"] . "</td>";
        // if ($_SESSION['Perfil']=='admin') {
        //     echo "<td>";    
        //     echo "<div class='btn-group'>";
        //     echo "<button id='divEditar" . $registro["Id_Equipo"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/editar.svg'><span class='visually-hidden'>Button</span></button>";
        //     echo "<button id='divEliminar" . $registro["Id_Equipo"] . "' type='button' class='btn btn-sm btn-outline-secondary'><img src='../img/borrar.svg'><span class='visually-hidden'>Button</span></button>";
        //     echo "</div>";
        //     echo "</td>";
        // }
        echo "</tr>";
    }

    echo "</tbody></table></div>";
}
