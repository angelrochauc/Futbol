<?php

function comboEquipo($mensaje = 'Seleccione Equipo del Jugador')
{
    include("connect.php");
    $resultado = $mysqli->query("SELECT Id_Equipo, Nombre_Equipo FROM equipo");
    // if ($torneo <> '0') {
    //     $resultado = $mysqli->query("SELECT Id_Equipo, Nombre_Equipo FROM equipo");
    // } else {
    //     $resultado = $mysqli->query("SELECT Id_Equipo, Nombre_Equipo FROM equipo e INNER JOIN equipo_torneo et ON e.Id_Equipo = et.Id_Equipo INNER JOIN torneo t ON et.Id_Torneo = t.Id_Torneo WHERE t.Id_Torneo = '". $torneo ."' ");
    // }

    echo "<select class='form-select' aria-label='Default select example' id='equipo' name='equipo' required oninvalid='this.setCustomValidity(\"Equipo del jugador es requerido\")'>";
    echo "<option value='' selected>" . $mensaje . "</option>";

    while ($registro = $resultado->fetch_array()) {
        echo "<option value='" . $registro["Id_Equipo"] . "'>" . $registro["Nombre_Equipo"] . "</option>";
    }

    echo "</select>";
}

function comboTorneo($mensaje = 'Seleccione Torneo')
{
    include("connect.php");
    $resultado = $mysqli->query("SELECT Id_Torneo, Nombre_Torneo FROM torneo");

    echo "<select class='form-select' aria-label='Default select example' id='torneo' name='torneo' required oninvalid='this.setCustomValidity(\"El torneo es requerido\")'>";
    echo "<option value='' selected>" . $mensaje . "</option>";

    while ($registro = $resultado->fetch_array()) {
        echo "<option value='" . $registro["Id_Torneo"] . "'>" . $registro["Nombre_Torneo"] . "</option>";
    }

    echo "</select>";
}

function comboJugador()
{
    include("connect.php");
    $resultado = $mysqli->query("SELECT Id_Jugador, Nombre_Apellido FROM jugador");

    echo "<select class='form-select' aria-label='Default select example' id='jugador' name='jugador' required oninvalid='this.setCustomValidity(\"El jugador es requerido\")'>";
    echo "<option value='' selected>Seleccione Jugador</option>";

    while ($registro = $resultado->fetch_array()) {
        echo "<option value='" . $registro["Id_Jugador"] . "'>" . $registro["Nombre_Apellido"] . "</option>";
    }

    echo "</select>";
}

function checksCanchas()
{
    include("connect.php");
    $resultado = $mysqli->query("SELECT Id_Cancha, Nombre_Cancha FROM cancha");
    echo '<hr /><h6>Canchas</h6><div class="row">';
    $i = 1;
    while ($registro = $resultado->fetch_array()) {
        if ($i == 1) echo '<div class="col">';
        echo '<div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="Canchas[]" id="Cancha' . $registro["Id_Cancha"] . '" value="' . $registro["Id_Cancha"] . '">
        <label class="form-check-label" for="Cancha' . $registro["Id_Cancha"] . '">' . $registro["Nombre_Cancha"] . '</label></div>';
        if ($i == 7) {
            echo '</div>';
            $i = 0;
        }
        $i++;
    }
    echo '</div></div>';
}

function checksEquipos()
{
    include("connect.php");
    $resultado = $mysqli->query("SELECT Id_Equipo, Nombre_Equipo FROM equipo");
    echo '<hr /><h6>Equipos</h6><div class="row">';
    $i = 1;
    while ($registro = $resultado->fetch_array()) {
        if ($i == 1) echo '<div class="col">';
        echo '<div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="Equipos[]" id="Equipo' . $registro["Id_Equipo"] . '" value="' . $registro["Id_Equipo"] . '">
        <label class="form-check-label" for="Equipo' . $registro["Id_Equipo"] . '">' . $registro["Nombre_Equipo"] . '</label></div>';
        if ($i == 7) {
            echo '</div>';
            $i = 0;
        }
        $i++;
    }
    echo '</div></div>';
}
