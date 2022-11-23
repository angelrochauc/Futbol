<?php
include("../assets/php/connect.php");
require_once('../assets/php/encoding.php');

use \ForceUTF8\Encoding;

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {

    $resultado = $mysqli->query("SELECT mainImage FROM project WHERE projectId = '" . $_POST['projectId'] . "'");
    while ($registro = $resultado->fetch_array()) {
        if (file_exists($registro["mainImage"])) {
            unlink($registro["mainImage"]);
        }
    }

    $mysqli->query("DELETE FROM project WHERE projectId = '" . $_POST['projectId'] . "'");

    $resultado = $mysqli->query("SELECT id, imageURL FROM gallery g INNER JOIN projectgallery pg ON g.id = pg.idGallery AND pg.idProject = '" . $_POST['projectId'] . "'");
    while ($registro = $resultado->fetch_array()) {
        if (file_exists($registro["imageURL"])) {
            unlink($registro["imageURL"]);
        }
        $mysqli->query("DELETE FROM gallery WHERE id = '" . $registro["id"] . "'");
    }

    $mysqli->query("DELETE FROM projectgallery WHERE idProject = '" . $_POST['projectId'] . "'");
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultar') {
    $resultado = $mysqli->query("SELECT projectName, description, category, client, projectDate, mainImage FROM project WHERE projectId = '" . $_POST['projectId'] . "'");
    $registro = $resultado->fetch_array(MYSQLI_ASSOC);

    $imagenes = $mysqli->query("SELECT * FROM (SELECT id, imageURL FROM gallery g INNER JOIN projectgallery pg ON g.id = pg.idGallery AND pg.idProject = '" . $_POST['projectId'] . "' ORDER BY id DESC LIMIT 6) sq ORDER BY id");

    for ($i = 2; $i <= 7; $i++) {

        unset($registro["image" . $i]);
        unset($registro["image" . $i . "Id"]);

        if ($imagen = $imagenes->fetch_array()) {
            $registro["image" . $i] = $imagen["imageURL"];
            $registro["image" . $i . "Id"] = $imagen["id"];
        }
    }
    echo json_encode(Encoding::toUTF8($registro));
    return;
}

if (isset($_POST['accion']) && $_POST['accion'] == 'guardar') {

    if (isset($_POST['category'])) {
        switch ($_POST['category']) {
            case 'construccion':
                $categoryDescription = 'Construcción';
                break;
            case 'mantenimiento':
                $categoryDescription = 'Mantenimiento Locativo';
                break;
            case 'demolicion':
                $categoryDescription = 'Residuos de construcción y demolición';
                break;
            case 'maquinaria':
                $categoryDescription = 'Alquiler de maquinaría';
                break;
            default:
                '';
                break;
        }
    }

    if (isset($_POST['projectId']) && $_POST['projectId'] != '') {

        if (isset($_FILES['mainImage']) && !empty($_FILES['mainImage']['name'])) {
            $resultado = $mysqli->query("SELECT mainImage FROM project WHERE projectId = '" . $_POST['projectId'] . "'");
            while ($registro = $resultado->fetch_array()) {
                if (file_exists($registro["mainImage"])) {
                    unlink($registro["mainImage"]);
                }
            }
            $mysqli->query("UPDATE project SET mainImage = '" . '../assets/gallery/' . $_FILES['mainImage']['name'] . "' WHERE projectId = '" . $_POST['projectId'] . "'");
        }

        for ($i = 2; $i <= 7; $i++) {
            if (!empty($_FILES['image' . $i]['name'])) {
                $mysqli->query("INSERT INTO gallery (name, imageURL) VALUES ('" . $_FILES['image' . $i]['name'] . "','" . '../assets/gallery/' . $_FILES['image' . $i]['name'] . "')");
                $GalleryId = $mysqli->insert_id;
                $mysqli->query("INSERT INTO projectgallery (idProject, idGallery) VALUES (" . $_POST['projectId'] . ", " . $GalleryId . ")");

                if (str_starts_with($_POST['image' . $i . 'Id'], 'c')) {
                    $mysqli->query("DELETE FROM gallery WHERE id = '" . str_replace('c', '', $_POST['image' . $i . 'Id']) . "'");
                    $mysqli->query("DELETE FROM projectgallery WHERE idGallery = '" . str_replace('c', '', $_POST['image' . $i . 'Id']) . "'");
                }
            }
        }

        if (isset($_POST['description']) && trim($_POST['description']) != '') {
            $mysqli->query("UPDATE project SET description = '" . $_POST['description'] . "' WHERE projectId = '" . $_POST['projectId'] . "'");
        }

        $mysqli->query("UPDATE project SET projectName = '" . $_POST['projectName'] . "', category = '" . $_POST['category'] . "', categoryDescription = '" . $categoryDescription . "', client = '" . $_POST['client'] . "', projectDate = '" . $_POST['projectDate'] . "' WHERE projectId = '" . $_POST['projectId'] . "'");
    } else {
        $resultado = $mysqli->query("SELECT * FROM project WHERE projectName = '" . $_POST['projectName'] . "'");

        if (mysqli_num_rows($resultado) == 0) {
            $mysqli->query("INSERT INTO project (projectName, description, category, categoryDescription, client, projectDate, mainImage) VALUES ('" . $_POST['projectName'] . "','" . $_POST['description'] . "','" . $_POST['category'] . "','" . $categoryDescription . "','" . $_POST['client'] . "','" . $_POST['projectDate'] . "','" . '../assets/gallery/' . $_FILES['mainImage']['name'] . "')");
            $ProjectId = $mysqli->insert_id;

            for ($i = 2; $i <= 7; $i++) {
                if (!empty($_FILES['image' . $i]['name'])) {
                    $mysqli->query("INSERT INTO gallery (name, imageURL) VALUES ('" . $_FILES['image' . $i]['name'] . "','" . '../assets/gallery/' . $_FILES['image' . $i]['name'] . "')");
                    $GalleryId = $mysqli->insert_id;
                    $mysqli->query("INSERT INTO projectgallery (idProject, idGallery) VALUES (" . $ProjectId . ", " . $GalleryId . ")");
                }
            }
        } else {
            echo "Error:0x001";
        }
    }

    if (isset($_FILES['mainImage']) && !empty($_FILES['mainImage']['name'])) {
        move_uploaded_file($_FILES['mainImage']['tmp_name'], '../assets/gallery/' . $_FILES['mainImage']['name']);
    }

    for ($i = 2; $i <= 7; $i++) {
        if (!empty($_FILES['image' . $i]['name'])) {
            move_uploaded_file($_FILES['image' . $i]['tmp_name'], '../assets/gallery/' . $_FILES['image' . $i]['name']);
        }
    }
}

$resultado = $mysqli->query("SELECT projectId, projectName, description, category, categoryDescription, client, projectDate, mainImage FROM project");

echo "<table class='table table-bordered'>";
echo "<thead><tr><th colspan='7'>Proyectos - <button id='Agregar' type='button' class='btn btn-sm btn-outline-secondary'>Agregar Proyecto</button></th></tr></thead>";
echo "<thead><tr><th>Nombre</th><th>Descripci&oacute;n</th><th>Categor&iacute;a</th><th>Cliente</th><th>Fecha</th><th>Imagen</th><th>Acciones</th></tr></thead>";
echo "<tbody>";

while ($registro = $resultado->fetch_array()) {
    echo "<tr class='table-light'>";
    echo "<td>" . Encoding::toUTF8($registro["projectName"]) . "</td>";
    echo "<td>" . Encoding::toUTF8($registro["description"]) . "</td>";
    echo "<td>" . Encoding::toUTF8($registro["categoryDescription"]) . "</td>";
    echo "<td>" . Encoding::toUTF8($registro["client"]) . "</td>";
    echo $registro["projectDate"] == "0000-00-00" ? "<td>&nbsp;</td>" : "<td>" . $registro["projectDate"] . "</td>";
    echo "<td><img src='" . $registro["mainImage"] . "' height='100px' alt='Construinco GM - " . Encoding::toUTF8($registro["projectName"]) . "'></td>";
    echo "<td>";
    echo "<div class='btn-group'>";
    echo "<button id='divEditar" . $registro["projectId"] . "' type='button' class='btn btn-sm btn-outline-secondary'>
        <svg xmlns='https://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'></path>
        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'></path>
        </svg><span class='visually-hidden'>Button</span>
        </button>";
    echo "<button id='divEliminar" . $registro["projectId"] . "' type='button' class='btn btn-sm btn-outline-secondary'>
        <svg xmlns='https://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
        <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z'></path>
        </svg><span class='visually-hidden'>Button</span>
        </button>";
    echo "</div>";
    echo "</td>";
    echo "</tr>";
}

echo "</tbody></table>";
