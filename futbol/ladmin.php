<?php
include("classes/auth.php");
if (isset($_SESSION["UserName"])) {
    header("location: menu.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Futbol</title>
    <link href="#" rel="shortcut icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" rel="stylesheet" integrity="sha512-NXUhxhkDgZYOMjaIgd89zF2w51Mub53Ru3zCNp5LTlEzMbNNAjTjDbpURYGS5Mop2cU4b7re1nOIucsVlrx9fA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="icon" href="img/favicon.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js" integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="bbc container">
    <center>
        <img class="mt-5 pt-5" src="img/logo.png" style="width: 20%;">
        <form class="mt-5" action="" method="post">
            <p class="pl">Iniciar Sesi&oacute;n</p>
            <input type="text" name="UserName" id="UserName" class="form-control" style="width: 30%; margin: 5px;" placeholder="Usuario" value="" autofocus>
            <input type="password" name="Password" id="Password" class="form-control" style="width: 30%; margin: 5px;" placeholder="Contraseña" value="">
            <input dirname="submit" name="submit" type="submit" id="login" class="btcs btn btn-light mt-4" value="Ingresar"></input>
            <br>
            <span><?php echo $error; ?></span>
        </form>

        <!-- <div><a href="registro.html" class="link-primary"><font size="-1">A&uacute;n no tienes usuario? Registrate</font></a></div> -->

    </center>
</body>

</html>