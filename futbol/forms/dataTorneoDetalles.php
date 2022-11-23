<?php
session_start();
include("../classes/connect.php");

$torneo = $_POST['torneo'];

$r_torneo = $mysqli->query("SELECT Nombre_Torneo, Fecha_Inicio, Fecha_Fin, Comentario FROM torneo WHERE Id_Torneo = '" . $torneo . "';");


echo "<div class='container text-center mt-5'>";
echo "<h5>Información Del Torneo</h5>";
echo "<table class='table'>";
echo "<thead class='ebc'><tr><th>Nombre Torneo</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Comentario</th></tr></thead>";
echo "<tbody>";
while ($registro = $r_torneo->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . $registro["Nombre_Torneo"] . "</td>";
    echo "<td>" . $registro["Fecha_Inicio"] . "</td>";
    echo "<td>" . $registro["Fecha_Fin"] . "</td>";
    echo "<td>" . $registro["Comentario"] . "</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

$r_canchas = $mysqli->query("SELECT c.Nombre_Cancha, c.Direccion, c.Telefono, c.Comentario FROM torneo t LEFT JOIN torneo_cancha tc ON t.Id_Torneo = tc.Id_Torneo LEFT JOIN cancha c ON tc.Id_Cancha = c.Id_Cancha WHERE t.Id_Torneo = '" . $torneo . "';");

echo "<div class='container text-center mt-5'>";
echo "<h5>Canchas</h5>";
echo "<table class='table'>";
echo "<thead class='ebc'><tr><th>Nombre Cancha</th><th>Direccion</th><th>Telefono</th><th>Comentario</th></tr></thead>";
echo "<tbody>";
while ($registro = $r_canchas->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . $registro["Nombre_Cancha"] . "</td>";
    echo "<td>" . $registro["Direccion"] . "</td>";
    echo "<td>" . $registro["Telefono"] . "</td>";
    echo "<td>" . $registro["Comentario"] . "</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

$r_equipos = $mysqli->query("SELECT Nombre_Equipo, e.Comentario FROM torneo t LEFT JOIN equipo_torneo et ON t.Id_Torneo = et.Id_Torneo LEFT JOIN equipo e ON et.Id_Equipo = e.Id_Equipo WHERE t.Id_Torneo = '" . $torneo . "';");

echo "<div class='container text-center mt-5'>";
echo "<h5>Equipos</h5>";
echo "<table class='table'>";
echo "<thead class='ebc'><tr><th>Nombre Equipo</th><th>Comentario</th></tr></thead>";
echo "<tbody>";
while ($registro = $r_equipos->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . $registro["Nombre_Equipo"] . "</td>";
    echo "<td>" . $registro["Comentario"] . "</td>";
    echo "</tr>";
}
echo "</tbody></table></div>";

$r_partidos = $mysqli->query("SELECT DISTINCT el.Nombre_Equipo EquipoL, ev.Nombre_Equipo EquipoV, p.Fecha_Hora, c.Nombre_Cancha FROM torneo t LEFT JOIN torneo_cancha tc ON t.Id_Torneo = tc.Id_Torneo LEFT JOIN cancha c ON tc.Id_Cancha = c.Id_Cancha LEFT JOIN partido p on tc.Id_Torneo_Cancha = p.Id_Torneo_Cancha LEFT JOIN equipo el on p.Id_Equipo_Local = el.Id_Equipo LEFT JOIN equipo ev on p.Id_Equipo_Visitante = ev.Id_Equipo WHERE t.Id_Torneo = '" . $torneo . "' AND el.Id_Equipo IS NOT NULL AND p.Fecha_Hora <> '0000-00-00';");

echo "<div class='container text-center mt-5'>";
echo "<h5>Partidos</h5>";
echo "<h8><i>(Las programaciones de los partidos son generadas automaticamente durante la creación del torneo y no pueden ser modificados)<i></h8>";
echo "<table class='table'>";
echo "<thead class='ebc'><tr><th>Equipo Local</th><th>Equipo Visitante</th><th>Fecha y Hora</th><th>Cancha</th></tr></thead>";
echo "<tbody>";

while ($registro = $r_partidos->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . $registro["EquipoL"] . "</td>";
    echo "<td>" . $registro["EquipoV"] . "</td>";
    echo "<td>" . $registro["Fecha_Hora"] . "</td>";
    echo "<td>" . $registro["Nombre_Cancha"] . "</td>";
    echo "</tr>";
}

echo "</tbody></table></div>";




