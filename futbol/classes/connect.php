<?php

$mysqli = new mysqli("127.0.0.1", "root", "", "futbol"); // Desarrollo

if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>