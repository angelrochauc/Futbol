<?php
session_start();
include("connect.php");
$error = '';

if (isset($_POST['submit'])) {

    if (empty($_POST['UserName']) || empty($_POST['Password'])) {
        $error = "Debe digitar un usuario y un Password";
    } else {

        $UserName = $_POST['UserName'];
        $Password = $_POST['Password'];

        $resultado = $mysqli->query("SELECT password, perfil FROM usuario WHERE Nombre_Usuario = '" . $UserName . "'");
        $row = $resultado->fetch_array();

        if (mysqli_num_rows($resultado) == 1) {
            if ($Password == $row["password"]) {
                $_SESSION['UserName'] = $UserName;
                $_SESSION['Perfil'] = $row["perfil"];
                header("location: ../auth/admin.php");
            } else {
                $error = "Password invalido";
            }
        } else {
            $error = "Usuario invalido";
        }
    }
}

