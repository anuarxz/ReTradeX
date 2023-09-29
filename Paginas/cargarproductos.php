<?php
include "global.php";
  
$campo = $_POST["campo"] ?? null;

$and = '';

if($campo != null){
    $and .= "AND (Nombre LIKE '%". $campo . "%');";
}


$html = " ";

if (!isset($error)) {
    $sql = "SELECT * FROM Productos WHERE 1=1 $and";
    $resultado = $dwes->query($sql);
    $sinResultados = true; // Variable para controlar si no hay resultados

    $html .= "<div class='container px-4 py-2 pb-5' id='custom-cards'>
    <div class='row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3'>";
    
    if ($resultado) {
      $row = $resultado->fetch();
      while ($row != null) {
          $sinResultados = false; // Se encontraron resultados

          $id = $row['IdProducto'];
          $nombre = $row['Nombre'];
          $precio = $row['Precio'];
          $descripcion = $row['Descripcion'];
          $foto = $row['Foto'];
          $foto1 = $row["Foto1"];
          $foto2 = $row["Foto2"];
          $foto3 = $row["Foto3"];
          $foto4 = $row["Foto4"];

          $html .= "<div class='col zoom'>
          <div class='card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg' style='background-image: url(\"$foto\");'>
            <div class='d-flex flex-column h-100 p-5 pb-3 text-shadow-1'>
            <h5 class='pt-5 mt-5 mb-5 lh-1 fw-bold'></h5>
              <ul class='d-flex list-unstyled mt-auto'>
                <li class='me-auto fw-bold'>
                $nombre
                </li>
                <li class='d-flex align-items-center me-2'>
                  <a href='producto.php?IdProducto=$id'><button type='button' class='btn btn-danger'>Comprar</button></a>
                </li>
              </ul>
            </div>
          </div>
        </div>";


        $row = $resultado->fetch();
      }

      $html .= "</div></div>";

    }

    if ($sinResultados) {
        $html .= " <div class='container px-4 py-2' id='custom-cards'>
        <h3 class='pb-5 text-center text-primary'>Sin resultados</h3>
        </div>";
    }
  }

echo json_encode($html, JSON_UNESCAPED_UNICODE);
  ?>
