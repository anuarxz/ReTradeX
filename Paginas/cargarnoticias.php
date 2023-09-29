<?php
include "global.php";
  
$campo = $_POST["campo"] ?? null;

$and = '';
$where = '';

if($campo != null){
    $and .= "AND (Titulo LIKE '%". $campo . "%' OR Fuente LIKE '%". $campo . "%' OR Categoria LIKE '%". $campo . "%');";
    $where .= "WHERE (Titulo LIKE '%". $campo . "%' OR Fuente LIKE '%". $campo . "%' OR Categoria LIKE '%". $campo . "%');";
}


$html = " ";

if (!isset($error)) {
    $sql = "SELECT DISTINCT Categoria FROM Noticias $where";
    $resultado = $dwes->query($sql);
    $sinResultados = true; // Variable para controlar si no hay resultados

    if ($resultado) {
      $row = $resultado->fetch();
      while ($row != null) {
        $categoria = $row['Categoria'];
        $html .= "<div class='container px-4 py-2' id='custom-cards'>
        <h2 class='pb-2 border-bottom'>$categoria</h2>
        <div class='row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3'>";

        $sql2 = "SELECT * FROM Noticias WHERE Categoria = '$categoria' $and";
        $resultado2 = $dwes->query($sql2);
        $row2 = $resultado2->fetch();
        while ($row2 != null) {
          $sinResultados = false; // Se encontraron resultados

          $nombre = $row2['Titulo'];
          $foto = $row2['Foto'];
          $fuente = $row2['Fuente'];
          $id = $row2["IdNoticia"];

          $html .= "<div class='col zoom'>
          <div class='card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg' style='background-image: url(\"$foto\");'>
            <div class='d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1'>
              <h3 class='pt-5 mt-5 mb-4 lh-1 fw-bold'>$nombre</h3>
              <ul class='d-flex list-unstyled mt-auto'>
                <li class='me-auto'>
                  $fuente 
                </li>
                <li class='d-flex align-items-center me-2'>
                  <a href='leernoticia.php?IdNoticia=$id'><button type='button' class='btn btn-danger'>Leer</button></a>
                </li>
              </ul>
            </div>
          </div>
        </div>";

          $row2 = $resultado2->fetch();
        }
        $html .= "</div></div>";
        $row = $resultado->fetch();
      }
    }

    if ($sinResultados) {
        $html .= " <div class='container px-4 py-2' id='custom-cards'>
        <h3 class='pb-5 text-center text-primary'>Sin resultados</h3>
        </div>";
    }
  }

echo json_encode($html, JSON_UNESCAPED_UNICODE);
  ?>
