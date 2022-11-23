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
            <div><h3 style="color: #ffffff;">Canchas</h3></div>
            <div class="container-fluid text-end">
                <button type="button" onclick="location.href= '../menu.php'" class="btcs btn btn-sm btn-light">
                    Menu
                </button>
                <button type="button" onclick="location.href= 'cambioPassword.php'" class="btcs btn btn-sm btn-light">
                    Cambio Contraseña
                </button>
                <button type="button" onclick="location.href= '../logout.php'" class="btcs btn btn-sm btn-light">
                    Cerrar Sesi&oacute;n
                </button>
            </div>
        </div>
        </div>
    </nav>

    <!-- Content Table -->
    <div id="respuesta"></div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!--  -->

    <!-- Hidden Modal Form -->
    <div class="modal fade" id="modalCancha" tabindex="-1" aria-labelledby="tituloModalCancha" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalCancha"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="errorMessage"></div>
                    <form id="fAddForm" class="needs-validation" autocomplete="off">
                        <!-- Hidden Input for ProjectId -->
                        <input type="hidden" id="CanchaId" name="CanchaId" value="">
                        <!-- Hidden Input for NuevoRegistro -->
                        <input type="hidden" id="NuevoRegistro" name="NuevoRegistro" value="1">
                        <!-- Equipo Name Input -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="CanchaName" name="CanchaName" required oninvalid="this.setCustomValidity('El nombre de la cancha es requerido')">
                            <label for="CanchaName">Nombre de la Cancha</label>
                        </div>
                        <!-- direccion Name Input -->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="direccion" name="direccion" required oninvalid="this.setCustomValidity('La direccion de la Cancha es requerido')"></input>
                            <label for="direccion" class="col-form-label">Direcci&oacute;n</label>
                        </div>
                        <!-- telefono Name Input -->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="telefono" name="telefono" required oninvalid="this.setCustomValidity('El telefono de la Cancha es requerido')"></input>
                            <label for="telefono" class="col-form-label">Tel&eacute;fono</label>
                        </div>
                        <!-- comentario Name Input -->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="comentarioName" name="comentarioName" required oninvalid="this.setCustomValidity('La Comentario del usuario es requerido')"></input>
                            <label for="comentarioName" class="col-form-label">Comentario</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-sm btn-primary" id="btn-guardar" style="background-color: #00CCA0; border-color: #00CCA0;">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!--  -->

    <!-- Hidden Modal Message -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalEliminar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Cancha</h5>
                    <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Realmente desea eliminar la Cancha?</p>
                    <form id="fDelConfirmation" autocomplete="off">
                        <input type="hidden" id="canchaEliminar" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="btn-eliminar" style="background-color: #00CCA0; border-color: #00CCA0;">Eliminar</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--  -->

    <!-- Footer -->
    <footer class="fixed-bottom d-flex flex-wrap justify-content-between align-items-center py-3 border-top bg-white">
        <p class="col-md-12 mb-0 text-center">&copy;&nbsp;Copyright&nbsp;<strong><span>2022 Futbol.</span></strong>&nbsp;All Rights Reserved</p>
    </footer>
    <!--  -->

</body>

</html>

<script type="text/javascript">
    var modalCancha = bootstrap.Modal.getOrCreateInstance($('#modalCancha'));
    var modalEliminar = bootstrap.Modal.getOrCreateInstance($('#modalEliminar'));

    $(document).ready(function() {
        $.ajax({
            url: 'dataCancha.php',
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
            }
        });
    });

    $("#respuesta").on("click", "button", function(event) {
        var id = $(this).attr('id') || '';
        if (id.includes('Agregar')) {
            agregarCancha();
        }
        if (id.includes('Editar')) {
            var CanchaId = id.replace('divEditar', '');
            editarCancha(CanchaId);
        }
        if (id.includes('Eliminar')) {
            var CanchaId = id.replace('divEliminar', '');
            eliminarCancha(CanchaId);
        }
    });

    $("#modalEliminar").on("click", "#btn-eliminar", function(event) {
        eliminar();
    });

    $("#modalCancha").on("click", "#btn-guardar", function(event) {
        var form = $('#fAddForm')[0];
        if (!form.checkValidity()) {
            form.reportValidity();
            event.preventDefault();
            event.stopPropagation();
        } else {
            form.classList.add('was-validated');
            guardar();
        }
    });

    function agregarCancha() {
        var Titulo = $('#modalCancha')[0].querySelector('.modal-title');
        Titulo.textContent = 'Ingresar Nueva Cancha';
        modalCancha.show();
        $("#NuevoRegistro").val('1');
    };

    function editarCancha(CanchaId) {
        var Titulo = $('#modalCancha')[0].querySelector('.modal-title');
        Titulo.textContent = 'Editar Cancha';
        modalCancha.show();
        $("#CanchaId").val(CanchaId);
        $("#NuevoRegistro").val('0');
        $.ajax({
            url: 'dataCancha.php',
            type: 'POST',
            data: {
                CanchaId: CanchaId,
                accion: 'consultar'
            },
            success: function(r) {
                var arrayUsuario = jQuery.parseJSON(r);
                $("#CanchaId").val(arrayUsuario.Id_Cancha);
                $("#CanchaName").val(arrayUsuario.Nombre_Cancha);
                $("#direccion").val(arrayUsuario.Direccion);
                $("#telefono").val(arrayUsuario.Telefono);
                $("#comentarioName").val(arrayUsuario.Comentario);
            }
        });
    };

    function eliminarCancha(CanchaId) {
        modalEliminar.show();
        $("#canchaEliminar").val(CanchaId);
    }

    function guardar() {
        var formData = new FormData($('#fAddForm')[0]);
        formData.append("accion", "guardar");
        $.ajax({
            url: 'dataCancha.php',
            data: formData,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
                notification('Chancha Guardada', 'success');
            }
        });
        $('#fAddForm')[0].reset();
        modalCancha.hide();
    }

    function eliminar() {
        var CanchaId = $("#canchaEliminar").val();
        $.ajax({
            url: 'dataCancha.php',
            data: {
                CanchaId: CanchaId,
                accion: 'eliminar'
            },
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
            }
        });
        modalEliminar.hide();
        notification('Cancha Eliminada', 'success');
    }

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