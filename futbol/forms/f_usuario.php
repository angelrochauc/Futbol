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
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="tituloModalUsuario" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalUsuario"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="errorMessage"></div>
                    <form id="fAddForm" class="needs-validation" autocomplete="off">
                        <!-- Hidden Input for ProjectId -->
                        <input type="hidden" id="usuarioId" name="usuarioId" value="">
                        <!-- Hidden Input for NuevoRegistro -->
                        <input type="hidden" id="NuevoRegistro" name="NuevoRegistro" value="1">
                        <!-- Usuario Name Input -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="usuarioName" name="usuarioName" required oninvalid="this.setCustomValidity('El nombre del usuario es requerido')">
                            <label for="usuarioName">Nombre</label>
                        </div>
                        <!-- cedula Name Input -->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="cedula" name="cedula" required oninvalid="this.setCustomValidity('La cedula del usuario es requerido')"></input>
                            <label for="cedula" class="col-form-label">Cedula</label>
                        </div>
                        <!-- contraseña Name Input -->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" required oninvalid="this.setCustomValidity('El password del usuario es requerido')"></input>
                            <label for="password" class="col-form-label">Contraseña</label>
                        </div>
                        <!-- Perfil Input -->
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" id="perfil" name="perfil" required oninvalid="this.setCustomValidity('El perfil del usuario es requerido')">
                                <option value="" selected>Perfil</option>
                                <option value="admin">Admin</option>
                                <option value="usuario">Usuario</option>
                            </select>
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
                    <h5 class="modal-title">Eliminar Usuario</h5>
                    <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Realmente desea eliminar el Usuario?</p>
                    <form id="fDelConfirmation" autocomplete="off">
                        <input type="hidden" id="usuarioEliminar" value="">
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
    var modalUsuario = bootstrap.Modal.getOrCreateInstance($('#modalUsuario'));
    var modalEliminar = bootstrap.Modal.getOrCreateInstance($('#modalEliminar'));

    $(document).ready(function() {
        $.ajax({
            url: 'dataUsuario.php',
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
            }
        });
    });

    $("#respuesta").on("click", "button", function(event) {
        var id = $(this).attr('id') || '';
        if (id.includes('Agregar')) {
            agregarUsuario();
        }
        if (id.includes('Editar')) {
            var usuarioId = id.replace('divEditar', '');
            editarUsuario(usuarioId);
        }
        if (id.includes('Eliminar')) {
            var usuarioId = id.replace('divEliminar', '');
            eliminarUsuario(usuarioId);
        }
    });

    $("#modalEliminar").on("click", "#btn-eliminar", function(event) {
        eliminar();
    });

    $("#modalUsuario").on("click", "#btn-guardar", function(event) {
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

    function agregarUsuario() {
        var Titulo = $('#modalUsuario')[0].querySelector('.modal-title');
        Titulo.textContent = 'Ingresar Nuevo Usuario';
        modalUsuario.show();
        $("#NuevoRegistro").val('1');
    };

    function editarUsuario(usuarioId) {
        var Titulo = $('#modalUsuario')[0].querySelector('.modal-title');
        Titulo.textContent = 'Editar Usuario';
        modalUsuario.show();
        $("#usuarioId").val(usuarioId);
        $("#NuevoRegistro").val('0');
        $.ajax({
            url: 'dataUsuario.php',
            type: 'POST',
            data: {
                usuarioId: usuarioId,
                accion: 'consultar'
            },
            success: function(r) {
                var arrayUsuario = jQuery.parseJSON(r);
                $("#usuarioId").val(arrayUsuario.Id_Usuario);
                $("#usuarioName").val(arrayUsuario.Nombre_Usuario);
                $("#cedula").val(arrayUsuario.cedula);
                $("#password").val(arrayUsuario.password);
                $("#perfil").val(arrayUsuario.perfil).change();
            }
        });
    };

    function eliminarUsuario(usuarioId) {
        modalEliminar.show();
        $("#usuarioEliminar").val(usuarioId);
    }

    function guardar() {
        var formData = new FormData($('#fAddForm')[0]);
        formData.append("accion", "guardar");
        $.ajax({
            url: 'dataUsuario.php',
            data: formData,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
                notification('Usuario Guardado', 'success');
            }
        });
        $('#fAddForm')[0].reset();
        modalUsuario.hide();
    }

    function eliminar() {
        var usuarioId = $("#usuarioEliminar").val();
        $.ajax({
            url: 'dataUsuario.php',
            data: {
                usuarioId: usuarioId,
                accion: 'eliminar'
            },
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
            }
        });
        modalEliminar.hide();
        notification('Usuario Eliminado', 'success');
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