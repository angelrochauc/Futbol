<?php
session_start();
if (!isset($_SESSION['UserName'])) {
    header("location: ../ladmin.php");
}

include("../classes/elementosDinamicos.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futbol</title>
    <link rel="icon" href="../img/favicon.png">
    <!--  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqwidgets/14.0.0/jqwidgets/styles/jqx.base.min.css" integrity="sha512-oqfScnAKrfZRqF4PSJtiZ0TnEgegI5F313JSCxFegHWdhScorKmc2vs57Vb2f4mnGetOSPUVXtwASFsP/rRgFA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqwidgets/14.0.0/jqwidgets/styles/jqx.flat.min.css" integrity="sha512-VGkIwdLhiAAqxOUGBEPwrp/jViKbwJLV+JXc9gj1JNFY1fAZxdE6i7x3fbl54rBwyRH1097/vnDRXajJ0PY8uQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/estilos.css">
    <!--  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js" integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqwidgets/14.0.0/jqwidgets/jqx-all.min.js" integrity="sha512-ZUxHFEM9FIh7yU3A7G4n4PAR/KvgHbmtlp3qe4EckzI+a/ZPYjQZ0iYKWAbiUBCWvN+3tISW1DZFSI1sfe8tlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--  -->

</head>

<body>

    <nav class="bc navbar navbar-dark navbar-expand-md sticky-top">
        <div class="container ">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">
                    <img src="../img/logo.png" alt="Logo" width="70" class="d-inline-block align-text-top">
                </span>
            </div>
            <div class="container-fluid text-end">
                <button type="button" onclick="location.href= '../menu.php'" class="btcs btn btn-sm btn-light">
                    Menu
                </button>
                <button type="button" onclick="location.href= '../logout.php'" class="btcs btn btn-sm btn-light">
                    Cerrar Sesi&oacute;n
                </button>
                <button type="button" onclick="location.href= 'cambioPassword.php'" class="btcs btn btn-sm btn-light">
                    Cambio Contraseña
                </button>
            </div>
        </div>
        </div>
    </nav>

    <!-- Content Table -->
    <div id="respuesta">
        <div class='container-sm text-center mt-5 w-25'>
            <form id="fPassword" class="needs-validation" autocomplete="off">
                <!-- Hidden Input for NombreUsuario -->
                <input type="hidden" id="NombreUsuario" name="NombreUsuario" value="<?php echo $_SESSION['UserName']; ?>">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" required>
                    <label for="Password" class="form-label">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="PasswordRepeat" name="PasswordRepeat" placeholder="Repetir Password" required>
                    <label for="PasswordRepeat" class="form-label">Repetir Password</label>
                </div>
                <button type="button" class="btn btn-sm btn-primary" id="btn-guardar" style="background-color: #00CCA0; border-color: #00CCA0;">Guardar</button>
            </form>
        </div>
    </div>
    <!--  -->

    <!-- Footer -->
    <footer class="fixed-bottom d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-12 mb-0 text-center">&copy;&nbsp;Copyright&nbsp;<strong><span>2022 Futbol.</span></strong>&nbsp;All Rights Reserved</p>
    </footer>
    <!--  -->

</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        console.log('Document Ready');
    });

    $("#fPassword").on("click", "#btn-guardar", function(event) { 
        var formData = new FormData($('#fPassword')[0]);
        formData.append("accion", "guardar");
        $.ajax({
            url: 'dataPassword.php',
            data: formData,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(r) {
                notification('Password Cambiado Con Exito', 'success');
            }
        });
        $('#fPassword')[0].reset();
    });

    function notification(text, type) {
        new Noty({
            type: type,
            layout: 'bottomCenter',
            timeout: 2000,
            theme: 'sunset',
            text: text
        }).show();
    }
</script>