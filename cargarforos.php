<?php
include "global.php";
  
$campo = $_POST["campo"] ?? null;

$and = '';
$where = '';

if($campo != null){
    $and .= "AND (Titulo LIKE '%". $campo . "%');";
    $where .= "WHERE (Titulo LIKE '%". $campo . "%');";
}


$html = "<div class='container px-4 py-2' id='custom-cards'>";

if (!isset($error)) {
    $sql = "SELECT * FROM Foro $where";
    $resultado = $dwes->query($sql);
    $sinResultados = true; // Variable para controlar si no hay resultados

    if ($resultado) {
      $row = $resultado->fetch();
      while ($row != null) {

        $id = $row['IdForo'];
        $fecha = $row['Fecha'];
        $titulo = $row['Titulo'];
        $descripcion = $row['Descripcion'];
        $icono = $row['Icono'];
        
          $sql2 = "SELECT count(*) as total FROM Entradas WHERE IdForo=". $id;
          $resultado2 = $dwes->query($sql2);
          if ($resultado2 != null) {
            $row2 = $resultado2->fetch();
            while ($row2 != null) {
              $numentradas = $row2['total'];
              $row2 = $resultado2->fetch();
            }
          }

          $sinResultados = false; 

          $html .= "<a href='entradas.php?IdForo=$id'><h3 class='pb-2 border-bottom' style='color: black !important;'>$icono $titulo</h3></a><p>Fecha de creación: $fecha - Número de entradas: $numentradas</p><br>";

        
        $row = $resultado->fetch();
      }
      $html .= "</div>";

    }

    if ($sinResultados) {
        $html .= " <div class='container px-4 py-2' id='custom-cards'>
        <h3 class='pb-5 text-center text-primary'>Sin resultados</h3>
        </div>";
    }
  }

echo json_encode($html, JSON_UNESCAPED_UNICODE);
  ?>
