<?php
session_start();
if (!isset($_SESSION['UserName'])) {
    header("location: ladmin.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misul Digital - Content Management System</title>
    <!--  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/css/bootstrap/zebra_datepicker.css" integrity="sha512-jGnP90W9TO7rAXE8dkl8c91DsyVxOKkMP7+fvYGW90qfp5QfHwinUADn4K+jyhDKdynKbS6DR+1UAiEyFl1dcQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqwidgets/14.0.0/jqwidgets/styles/jqx.base.min.css" integrity="sha512-oqfScnAKrfZRqF4PSJtiZ0TnEgegI5F313JSCxFegHWdhScorKmc2vs57Vb2f4mnGetOSPUVXtwASFsP/rRgFA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqwidgets/14.0.0/jqwidgets/styles/jqx.flat.min.css" integrity="sha512-VGkIwdLhiAAqxOUGBEPwrp/jViKbwJLV+JXc9gj1JNFY1fAZxdE6i7x3fbl54rBwyRH1097/vnDRXajJ0PY8uQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js" integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.19/zebra_datepicker.min.js" integrity="sha512-KtN0FO60US4/jwC1DajXPg9ZANJxs2DDC4utQFTfFdf7Ckpmt4gLKzTJhfEK0yEeCq2BvcMKWdMGRmiGiPnztQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqwidgets/14.0.0/jqwidgets/jqx-all.min.js" integrity="sha512-ZUxHFEM9FIh7yU3A7G4n4PAR/KvgHbmtlp3qe4EckzI+a/ZPYjQZ0iYKWAbiUBCWvN+3tISW1DZFSI1sfe8tlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--  -->

</head>

<body>

    <nav class="navbar navbar-dark bg-dark navbar-expand-md sticky-top">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">
                <img src="misul.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                Administrador de Contenido
            </span>
        </div>

        <div class="container-fluid justify-content-end">
            <button type="button" onclick="location.href= 'auth/logout.php'" class="btn btn-sm btn-light">
                Cerrar Sesi&oacute;n
            </button>
        </div>
        </div>
    </nav>

    <!-- Content Table -->
    <div id="respuesta"></div>
    <!--  -->

    <!-- Hidden Modal Form -->
    <div class="modal fade" id="modalProyecto" tabindex="-1" aria-labelledby="tituloModalProyecto" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalProyecto"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="errorMessage"></div>
                    <form id="fAddForm" class="needs-validation" autocomplete="off">
                        <!-- Hidden Input for ProjectId -->
                        <input type="hidden" id="projectId" name="projectId" value="">
                        <!-- Project Name Input -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="projectName" name="projectName" required oninvalid="this.setCustomValidity('El nombre del proyecto es requerido')">
                            <label for="projectName">Nombre del Proyecto</label>
                        </div>
                        <!-- Main Image Input -->
                        <div class="mb-3">
                            <img id="mainImageDisplay" height="200px" src="" style="display:none"><br>
                            <button type="button" class="btn btn-sm btn-light" onclick="document.getElementById('mainImage').click()">Seleccionar Imagen Principal</button>&nbsp;&nbsp;&nbsp;<span id="mainImageData"></span>
                            <input type="file" class="form-control" id="mainImage" name="mainImage" style="display:none">
                        </div>
                        <!-- Description Input -->
                        <div class="form-floating mb-3">
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                            <label for="description" class="col-form-label">Descripci&oacute;n</label>
                        </div>
                        <!-- Category Input -->
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" id="category" name="category" required oninvalid="this.setCustomValidity('La categoria es requerida')">
                                <option value="" selected>Seleccione una categoria</option>
                                <option value="construccion">Construcci&oacute;n</option>
                                <option value="mantenimiento">Mantenimiento Locativo</option>
                                <option value="demolicion">Residuos de construcci&oacute;n y demolici&oacute;n</option>
                                <option value="maquinaria">Alquiler de maquinar&iacute;a</option>
                            </select>
                        </div>
                        <!-- Client Name Input -->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="client" name="client" required oninvalid="this.setCustomValidity('El nombre del cliente es requerido')"></input>
                            <label for="client" class="col-form-label">Cliente</label>
                        </div>
                        <!-- Project Date Input -->
                        <div class="mb-3">
                            <label for="projectDate" class="col-form-label">Fecha Proyecto</label>
                            <input id="projectDate" name="projectDate" required></input>
                        </div>
                        <!-- Aditional Images -->
                        <p class="col-form-label">Imagenes Adicionales</p>
                        <div class="mb-3">
                            <input type="hidden" id="image2Id" name="image2Id" value="">
                            <img id="image2Display" height="200px" src="" style="display:none">
                            <button type="button" class="btn btn-sm btn-light" onclick="document.getElementById('image2').click()">Seleccionar Imagen</button>&nbsp;&nbsp;&nbsp;<span id="image2Data"></span>
                            <input type="file" class="form-control" id="image2" name="image2" style="display:none">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" id="image3Id" name="image3Id" value="">
                            <img id="image3Display" height="200px" src="" style="display:none">
                            <button type="button" class="btn btn-sm btn-light" onclick="document.getElementById('image3').click()">Seleccionar Imagen</button>&nbsp;&nbsp;&nbsp;<span id="image3Data"></span>
                            <input type="file" class="form-control" id="image3" name="image3" style="display:none">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" id="image4Id" name="image4Id" value="">
                            <img id="image4Display" height="200px" src="" style="display:none">
                            <button type="button" class="btn btn-sm btn-light" onclick="document.getElementById('image4').click()">Seleccionar Imagen</button>&nbsp;&nbsp;&nbsp;<span id="image4Data"></span>
                            <input type="file" class="form-control" id="image4" name="image4" style="display:none">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" id="image5Id" name="image5Id" value="">
                            <img id="image5Display" height="200px" src="" style="display:none">
                            <button type="button" class="btn btn-sm btn-light" onclick="document.getElementById('image5').click()">Seleccionar Imagen</button>&nbsp;&nbsp;&nbsp;<span id="image5Data"></span>
                            <input type="file" class="form-control" id="image5" name="image5" style="display:none">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" id="image6Id" name="image6Id" value="">
                            <img id="image6Display" height="200px" src="" style="display:none">
                            <button type="button" class="btn btn-sm btn-light" onclick="document.getElementById('image6').click()">Seleccionar Imagen</button>&nbsp;&nbsp;&nbsp;<span id="image6Data"></span>
                            <input type="file" class="form-control" id="image6" name="image6" style="display:none">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" id="image7Id" name="image7Id" value="">
                            <img id="image7Display" height="200px" src="" style="display:none">
                            <button type="button" class="btn btn-sm btn-light" onclick="document.getElementById('image7').click()">Seleccionar Imagen</button>&nbsp;&nbsp;&nbsp;<span id="image7Data"></span>
                            <input type="file" class="form-control" id="image7" name="image7" style="display:none">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-sm btn-primary" id="btn-guardar" style="background-color: #F3A3F7; border-color: #F3A3F7;">Guardar</button>
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
                    <h5 class="modal-title">Eliminar Proyecto</h5>
                    <button type="button" class="btn btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Realmente desea eliminar el proyecto?</p>
                    <form id="fDelConfirmation" autocomplete="off">
                        <input type="hidden" id="proyectoEliminar" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="btn-eliminar" style="background-color: #F3A3F7; border-color: #F3A3F7;">Eliminar</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--  -->

    <!-- Footer -->
    <footer class="fixed-bottom d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-12 mb-0 text-muted">&copy;&nbsp;Copyright&nbsp;<strong><span>2022 Misul Digital.</span></strong>&nbsp;All Rights Reserved</p>
    </footer>
    <!--  -->

</body>

</html>

<script type="text/javascript">
    var modalProyecto = bootstrap.Modal.getOrCreateInstance($('#modalProyecto'));
    var modalEliminar = bootstrap.Modal.getOrCreateInstance($('#modalEliminar'));

    $(document).ready(function() {
        $.ajax({
            url: 'data.php',
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
            }
        });
    });

    $("#respuesta").on("click", "button", function(event) {

        var id = $(this).attr('id') || '';

        if (id.includes('Agregar')) {
            agregarProyecto();
        }
        if (id.includes('Editar')) {
            var projectId = id.replace('divEditar', '');
            editarProyecto(projectId);
        }
        if (id.includes('Eliminar')) {
            var projectId = id.replace('divEliminar', '');
            eliminarProyecto(projectId);
        }
    });

    $("#modalEliminar").on("click", "#btn-eliminar", function(event) {
        eliminar();
    });

    $("#modalProyecto").on("click", "#btn-guardar", function(event) {

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

    function agregarProyecto() {
        var Titulo = $('#modalProyecto')[0].querySelector('.modal-title');
        Titulo.textContent = 'Agregar Proyecto';

        modalProyecto.show();

        $('#fAddForm')[0].reset();
        $('#mainImageDisplay, #image2Display, #image3Display, #image4Display, #image5Display, #image6Display, #image7Display').hide();
        $('#mainImageData, #image2Data, #image3Data, #image4Data, #image5Data, #image6Data, #image7Data').empty();

        $("input:file").change(function() {
            $('#' + $(this).attr('id') + 'Data').html('Nombre de la imagen: <b>' + $('#' + $(this).attr('id'))[0].files[0].name + '</b>');
        });

        window.setTimeout(function() {
            $('#projectDate').Zebra_DatePicker({
                icon_margin: 6
            });

            $('#description').jqxEditor({
                height: '250px',
                width: '100%',
                tools: "bold italic underline | left center right | outdent indent | ul ol | clean",
                theme: "flat"
            });

            $("#description").val('');

        }, 300);

    };

    function editarProyecto(projectId) {

        var Titulo = $('#modalProyecto')[0].querySelector('.modal-title');
        Titulo.textContent = 'Editar Proyecto';

        modalProyecto.show();

        $('#mainImageData, #image2Data, #image3Data, #image4Data, #image5Data, #image6Data, #image7Data').empty();

        $("#projectId").val(projectId);

        $.ajax({
            url: 'data.php',
            type: 'POST',
            data: {
                projectId: projectId,
                accion: 'consultar'
            },
            success: function(r) {
                //console.log(r);

                var arrayProyecto = jQuery.parseJSON(r);

                //Datos Principales
                $("#projectId").val(projectId);
                $("#projectName").val(arrayProyecto.projectName);
                $("#description").val(arrayProyecto.description);
                $("#category").val(arrayProyecto.category).change();
                $("#client").val(arrayProyecto.client);
                $("#projectDate").val(arrayProyecto.projectDate);

                //Imagen Principal
                $("#mainImageDisplay").attr("src", arrayProyecto.mainImage);
                $("#mainImageDisplay").show();

                //Imagenes Adicionales
                if (typeof arrayProyecto.image2 != 'undefined') {
                    $("#image2Display").attr("src", arrayProyecto.image2);
                    $("#image2Display").show();
                    $("#image2Id").val(arrayProyecto.image2Id);
                } else {
                    $("#image2Display").hide();
                }

                if (typeof arrayProyecto.image3 != 'undefined') {
                    $("#image3Display").attr("src", arrayProyecto.image3);
                    $("#image3Display").show();
                    $("#image3Id").val(arrayProyecto.image3Id);
                } else {
                    $("#image3Display").hide();
                }

                if (typeof arrayProyecto.image4 != 'undefined') {
                    $("#image4Display").attr("src", arrayProyecto.image4);
                    $("#image4Display").show();
                    $("#image4Id").val(arrayProyecto.image4Id);
                } else {
                    $("#image4Display").hide();
                }

                if (typeof arrayProyecto.image5 != 'undefined') {
                    $("#image5Display").attr("src", arrayProyecto.image5);
                    $("#image5Display").show();
                    $("#image5Id").val(arrayProyecto.image5Id);
                } else {
                    $("#image5Display").hide();
                }

                if (typeof arrayProyecto.image6 != 'undefined') {
                    $("#image6Display").attr("src", arrayProyecto.image6);
                    $("#image6Display").show();
                    $("#image6Id").val(arrayProyecto.image6Id);
                } else {
                    $("#image6Display").hide();
                }

                if (typeof arrayProyecto.image7 != 'undefined') {
                    $("#image7Display").attr("src", arrayProyecto.image6);
                    $("#image7Display").show();
                    $("#image7Id").val(arrayProyecto.image6Id);
                } else {
                    $("#image7Display").hide();
                }
            }
        });

        $("input:file").change(function() {

            var id = $(this).attr('id') || '';

            $('#' + id + 'Data').html('Nombre de la imagen: <b>' + $('#' + id)[0].files[0].name + '</b>');
            if (!id.includes('mainImage')) {
                var newValue = 'c' + $('#' + id + 'Id').val()
                $('#' + id + 'Id').val(newValue);
            }
        });

        window.setTimeout(function() {
            $('#projectDate').Zebra_DatePicker({
                icon_margin: 6
            });

            var editorContent = $('#description').val();

            $('#description').jqxEditor({
                height: '300px',
                width: '100%',
                tools: "bold italic underline | left center right | outdent indent | ul ol | clean",
                theme: "flat"
            });

            $("#description").val(editorContent);

        }, 300);

    };

    function eliminarProyecto(projectId) {
        modalEliminar.show();
        $("#proyectoEliminar").val(projectId);
    }

    function guardar() {

        var formData = new FormData($('#fAddForm')[0]);
        formData.append("accion", "guardar");

        //console.log(formData);

        $.ajax({
            url: 'data.php',
            data: formData,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(r) {
                //console.log(r);
                if (r.includes('Error:0x001')) {
                    notification('El proyecto ya existe, intente editando el proyecto', 'error');
                } else {
                    $('#respuesta').html(r);
                    notification('Proyecto Guardado', 'success');
                }
            }
        });

        $('#fAddForm')[0].reset();
        modalProyecto.hide();

    }

    function eliminar() {
        var projectId = $("#proyectoEliminar").val();
        $.ajax({
            url: 'data.php',
            data: {
                projectId: projectId,
                accion: 'eliminar'
            },
            type: 'POST',
            success: function(r) {
                $('#respuesta').html(r);
            }
        });

        modalEliminar.hide();

        notification('Proyecto Eliminado', 'success');

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