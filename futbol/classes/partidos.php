<?php

generarPartidosTorneo($_GET['torneo']);

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
        $r = rand(0,count($canchas)-1);       
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
