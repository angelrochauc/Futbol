<?php

include("connect.php");
require_once('encoding.php');

use \ForceUTF8\Encoding;

function getProjects()
{

  global $mysqli;
  $resultado = $mysqli->query("SELECT projectId, projectName, description, category, categoryDescription, client, projectDate, mainImage FROM project");

  echo "<!-- Start Projects Item -->";

  while ($registro = $resultado->fetch_array()) {
    echo "<div class='col-lg-4 col-md-6 portfolio-item filter-" . $registro["category"] . "'>
        <a href='proyecto/" . $registro["projectId"] . "'>
        <div class='portfolio-content h-100'>        
          <img src='" . str_replace('../', '', $registro["mainImage"]) . "' class='img-fluid' alt='Construinco GM - " . Encoding::toUTF8($registro["projectName"]) . "'>
          <div class='portfolio-info'>
              <h4>Ver m&aacute;s de este Proyecto ...</h4>
          </div>
        </div>
        </a>
        <div class='info-proyecto'>
        <p><b>" . substr(Encoding::toUTF8($registro["client"]), 0, 45) . "</b></p>
        <p>" . Encoding::toUTF8($registro["projectName"]) . "</p>
        </div>
        </div>
        ";
  }

  echo "<!-- End Projects Item -->";
}

function getProjectDetails($id)
{
  global $mysqli;
  $resultado = $mysqli->query("SELECT projectId, projectName, description, category, categoryDescription, client, projectDate, mainImage FROM project WHERE projectId = " . $id);

  while ($registro = $resultado->fetch_array()) {
    echo "<div class='col-lg-8'>
        <div class='portfolio-description'>
          <h3>" . Encoding::toUTF8($registro["projectName"]) . "</h3>
          <p>" . Encoding::toUTF8($registro["description"]) . "</p>
        </div>
      </div>
      <div class='col-lg-3'>
        <div class='portfolio-info'>
          <h3>Datos del Proyecto</h3>
          <ul>
            <li><strong>Categor&iacute;a</strong> <span>" . Encoding::toUTF8($registro["categoryDescription"]) . "</span></li>
            <li><strong>Cliente</strong> <span>" . Encoding::toUTF8($registro["client"]) . "</span></li>";
    echo $registro["projectDate"] == "0000-00-00" ? "" : "<li><strong>Fecha del Proyecto</strong><span>" . $registro["projectDate"] . "</span></li>";
    echo "</ul></div></div>";
  }
}

function getProjectImages($id)
{
  global $mysqli;
  $imagenes = $mysqli->query("SELECT 0 id, mainImage, projectName FROM project WHERE projectId = '" . $id . "' UNION SELECT id, imageURL, projectName FROM (SELECT id, imageURL, projectName FROM gallery g INNER JOIN projectgallery pg ON g.id = pg.idGallery INNER JOIN project p ON pg.idProject = p.projectId WHERE p.projectId = '" . $id . "' ORDER BY id DESC LIMIT 6) sq ORDER BY id;");

  echo "<!-- Start Image Item -->";

  while ($imagen = $imagenes->fetch_array()) {
    echo "<div class='swiper-slide'><img class='img-fluid rounded mx-auto d-block' src='" . str_replace('../', '', $imagen["mainImage"]) . "' alt='Construinco GM - " . Encoding::toUTF8($imagen["projectName"]) . "' style = 'max-height:768px; width:auto;'></div>";
  }

  echo "<!-- End Image Item -->";
}
