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
            <div><h3 style="color: #ffffff;">Estad&iacute;sticas Equipos</h3></div>
            <div class="container-fluid text-end">
                <button type="button" onclick="location.href= '../menuStats.php'" class="btcs btn btn-sm btn-light">
                    Menu Estadisticas
                </button>
                <button type="button" onclick="location.href= 'cambioPassword.php'" class="btcs btn btn-sm btn-light">
                    Cambio Contrase??a
                </button>
                <button type="button" onclick="location.href= '../logout.php'" class="btcs btn btn-sm btn-light">
                    Cerrar Sesi&oacute;n
                </button>
            </div>
        </div>
        </div>
    </nav>

    <div id="seleccionarTorneo" name="seleccionarTorneo">
        <?php comboTorneo('Primero es necesario seleccionar un torneo'); ?>
    </div>

    <!-- Content Table -->
    <div id="respuesta"></div>
    <!--  -->

    <!-- Hidden Modal Form -->
    <div class="modal fade" id="modalEquipo" tabindex="-1" aria-labelledby="tituloModalUsuario" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalUsuario"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="container-fluid modal-body">
                    <div id="errorMessage"></div>
                    <form id="fAddForm" class="needs-validation" autocomplete="off">
                        <!-- Hidden Input for ProjectId -->
                        <input type="hidden" id="EquipoId" name="EquipoId" value="">
                        <!-- Hidden Input for NuevoRegistro -->
                        <input type="hidden" id="NuevoRegistro" name="NuevoRegistro" value="1">
                        <!-- equipo Input -->
                        <div class="mb-3">
                            <?php comboEquipo('Seleccione Equipo'); ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Posici??n Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="posicion" name="posicion" placeholder="Posici??n">
                                    <label for="posicion">Posici??n</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Puntos Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="puntos" name="puntos" placeholder="Puntos">
                                    <label for="puntos">Puntos</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr />
                            <h6>Partidos</h6>
                            <div class="col-md-3">
                                <!-- PJ Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="PJ" name="PJ" placeholder="PJ">
                                    <label for="PJ">Jugados</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <!-- PG Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="PG" name="PG" placeholder="PG">
                                    <label for="PG">Ganados</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <!-- PP Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="PP" name="PP" placeholder="PP">
                                    <label for="PP">Perdidos</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <!-- PE Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="PE" name="PE" placeholder="PE">
                                    <label for="PE">Empatados</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr />
                            <h6>Goles</h6>
                            <div class="col-md-6">
                                <!-- GF Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="GF" name="GF" placeholder="GF">
                                    <label for="GF">A Favor</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- GC Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="GC" name="GC" placeholder="GC">
                                    <label for="GC">En Contra</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <hr />
                            <h6>Tarjetas</h6>
                            <div class="col-md-6">
                                <!-- TA Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="TA" name="TA" placeholder="TA">
                                    <label for="TA">Amarillas</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- TR Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="TR" name="TR" placeholder="TR">
                                    <label for="TR">Rojas</label>
                                </div>
                            </div>
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
                    <h5 class="modal-title">Eliminar Equipo</h5>
                    <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Realmente desea eliminar el Equipo?</p>
                    <form id="fDelConfirmation" autocomplete="off">
                        <input type="hidden" id="equipoEliminar" value="">
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
    var modalEquipo = bootstrap.Modal.getOrCreateInstance($('#modalEquipo'));
    var modalEliminar = bootstrap.Modal.getOrCreateInstance($('#modalEliminar'));

    $(document).ready(function() {
        $.ajax({
            url: 'dataStatsEquipo.php',
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
            }
        });
    });

    $("#seleccionarTorneo").on("change", "#torneo", function(event) {
        var porTorneo = $(this).val();
        $.ajax({
            url: 'dataStatsEquipo.php',
            type: 'POST',
            data: {
                porTorneo: porTorneo,
                torneo: $(this).val()
            },
            success: function(r) {
                $('#respuesta').html(r);
            }
        });
    });

    $("#respuesta").on("click", "button", function(event) {
        var id = $(this).attr('id') || '';
        if (id.includes('Agregar')) {
            agregarEquipo();
        }
        if (id.includes('Editar')) {
            var EquipoId = id.replace('divEditar', '');
            editarEquipo(EquipoId);
        }
        if (id.includes('Eliminar')) {
            var EquipoId = id.replace('divEliminar', '');
            eliminarEquipo(EquipoId);
        }
    });

    $("#modalEliminar").on("click", "#btn-eliminar", function(event) {
        eliminar();
    });

    $("#modalEquipo").on("click", "#btn-guardar", function(event) {
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

    function agregarEquipo() {
        var Titulo = $('#modalEquipo')[0].querySelector('.modal-title');
        Titulo.textContent = 'Ingresar Estadisticas del torneo ' + $("#torneo option:selected").text();
        modalEquipo.show();
        $("#NuevoRegistro").val('1');
    };

    function editarEquipo(EquipoId) {
        var Titulo = $('#modalEquipo')[0].querySelector('.modal-title');
        Titulo.textContent = 'Editar Equipo';
        modalEquipo.show();
        $("#EquipoId").val(EquipoId);
        var torneo = $("#torneo").val();
        $("#NuevoRegistro").val('0');
        $.ajax({
            url: 'dataStatsEquipo.php',
            type: 'POST',
            data: {
                EquipoId: EquipoId,
                accion: 'consultar'
            },
            success: function(r) {
                var arrayUsuario = jQuery.parseJSON(r);
                $("#EquipoId").val(arrayUsuario.Id_Equipo);
                $("#equipoName").val(arrayUsuario.Nombre_Equipo);
                $("#Comentario").val(arrayUsuario.Comentario);
            }
        });
    };

    function eliminarEquipo(EquipoId) {
        modalEliminar.show();
        $("#equipoEliminar").val(EquipoId);
    }

    function guardar() {
        var formData = new FormData($('#fAddForm')[0]);
        formData.append("accion", "guardar");
        formData.append("torneo", $("#torneo").val());
        $.ajax({
            url: 'dataStatsEquipo.php',
            data: formData,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
                notification('Estadisticas Guardadas', 'success');
            }
        });
        $('#fAddForm')[0].reset();
        modalEquipo.hide();
    }

    function eliminar() {
        var EquipoId = $("#equipoEliminar").val();
        $.ajax({
            url: 'dataStatsEquipo.php',
            data: {
                EquipoId: EquipoId,
                accion: 'eliminar'
            },
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
            }
        });
        modalEliminar.hide();
        notification('Equipo Eliminado', 'success');
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