<?php
//Iniciamos la sesion
session_start();
//Comrprobamos si es admin, de lo contrario nos devuelve al index.php
if($_SESSION['Admin']!=1)
{
  header("Location: index.php");
}  
include "global.php";//Realizamos la conexion a la bbdd
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReTradeX - Administracion</title>
    <link rel="icon" type="image/jpg" href="../Imagenes/logo.png"/>
    <link rel="stylesheet" href="../Estilos/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <!-- Creamos el menú con los enlaces -->
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-2">
      <a href="admin.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="img-fluid" src="../Imagenes/logo.png" height="75px" width="75px">
      </a>

      <ul class="nav nav-pills col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a href="admin.php" class="nav-link px-2 link-dark active">General</a></li>
        <li class="nav-item"><a href="adminclientes.php" class="nav-link px-2 link-dark">Clientes</a></li>
        <li class="nav-item"><a href="adminnoticias.php" class="nav-link px-2 link-dark">Noticias</a></li>
        <li class="nav-item"><a href="adminforo.php" class="nav-link px-2 link-dark">Foro</a></li>
        <li class="nav-item"><a href="admintienda.php" class="nav-link px-2 link-dark">Tienda</a></li>
      </ul>
      <div class="col-md-3 text-end">
        <a href="cerrarsesion.php"><button type="button" class="btn btn-outline-primary me-2 m-1">Cerrar Sesión</button></a>
      </div>
    </header>
  </div>
 
<?php
  if (!isset($error)) {
    //Cogemos los 3 últimos clientes
        $sql = "SELECT  * FROM Clientes ORDER BY IdCliente DESC LIMIT 3";
        $resultado = $dwes->query($sql);
        if ($resultado) {
      //Generamos un bucle y mostramos los clientes con sus datos
            $row = $resultado->fetch();
            echo " <div class='container px-4 py-5' id='custom-cards'>
                        <h2 class='pb-2 border-bottom'>Últimos clientes</h2>
                        <div class='align-items-stretch g-4 py-3'>";
            while ($row != null) {
                $id = $row['IdCliente'];
                $nombre = $row['Nombre'];
                $apellido = $row['Apellido'];
                $apodo = $row['Apodo'];
                $direccion = $row['Direccion'];
                $pais = $row['Pais'];
                $cp = $row['CP'];
                $dni = $row['DNI'];
                $correo = $row['Correo'];
                $telefono = $row['Telefono'];

                if($id!=$_SESSION['IdCliente'] && $id!=1){//Evitamos nuestro usuario y al admin principal
                echo "<div class='col pt-2'>
                        <div class='card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg' style='background-image: url();'>
                            <div class='d-flex flex-column h-100 p-5 pb-3 text-black text-shadow-1'>
                            <h3 class=' mt-2 mb-4 display-6 lh-1 fw-bold'>$nombre</h3>
                            <ul class='d-flex list-unstyled mt-auto'>
                                <li class='me-auto'>
                                <b>IdCliente:</b> $id <b>Nombre:</b> $nombre <b>Apellido:</b> $apellido <b>Correo:</b> $correo <b>Apodo:</b> $apodo <b>DNI:</b> $dni <b>Telefono:</b> $telefono
                                </li>
                            </ul>
                            </div>
                        </div>
                        </div>";
                }

                $row = $resultado->fetch();
            }
            echo " </div></div>";//Añadimos el boton para a la pagina clientes
            echo '<div class="col-12 d-flex justify-content-center"><a href="adminclientes.php"><button class="btn btn-primary" type="button">Administrar clientes</button></a></div>';        
        }
    }
    ?>

<?php
  if (!isset($error)) {
  $sql = "SELECT * FROM Productos ORDER BY IdProducto DESC LIMIT 3";//Seleccionamos los 3 últimos productos
  $resultado = $dwes->query($sql);

  echo "<div class='container px-4 py-4' id='custom-cards'>
  <h2 class='pb-2 border-bottom'>Últimos productos</h2>
  <div class='row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-4'>";
  //Genermos un bucle para mostrar los productos con sus datos
  if ($resultado) {
    $row = $resultado->fetch();
    while ($row != null) {
        $id = $row['IdProducto'];
        $nombre = $row['Nombre'];
        $precio = $row['Precio'];
        $descripcion = $row['Descripcion'];
        $foto = $row['Foto'];
        $foto1 = $row["Foto1"];
        $foto2 = $row["Foto2"];
        $foto3 = $row["Foto3"];
        $foto4 = $row["Foto4"];

        echo "<div class='col zoom'>
        <div class='card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg' style='background-image: url(\"$foto\");'>
          <div class='d-flex flex-column h-100 p-5 pb-3 text-shadow-1'>
          <h5 class='pt-5 mt-5 mb-5 lh-1 fw-bold'></h5>
            <ul class='d-flex list-unstyled mt-auto'>
              <li class='me-auto fw-bold'>
              $nombre
              </li>
            </ul>
          </div>
        </div>
      </div>";

      $row = $resultado->fetch();
    }
    echo "</div></div>";//Añadimmos un boton para ir la pagina de los productos
    echo '<div class="col-12 d-flex justify-content-center"><a href="admintienda.php"><button class="btn btn-primary" type="button">Administrar productos</button></a></div>';
  }
}


?>

 
<?php
  if (!isset($error)) {
    $sql = "SELECT DISTINCT * FROM Noticias ORDER BY IdNoticia DESC LIMIT 3";//obtenemos las 3 ultimass noticias
    $resultado = $dwes->query($sql);

    echo "<div class='container px-4 py-4' id='custom-cards'>
    <h2 class='pb-2 border-bottom'>Últimas noticias</h2>
    <div class='row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3'>";

    if ($resultado) {
      $row = $resultado->fetch();
      while ($row != null) {
//genreamos un bucle con las noticias y sus datos
          $nombre = $row['Titulo'];
          $foto = $row['Foto'];
          $fuente = $row['Fuente'];
          $id = $row["IdNoticia"];

          echo "<div class='col zoom'>
          <div class='card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg' style='background-image: url(\"$foto\");'>
            <div class='d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1'>
              <h3 class='pt-5 mt-5 mb-4 lh-1 fw-bold'>$nombre</h3>
              <ul class='d-flex list-unstyled mt-auto'>
                <li class='me-auto'>
                  $fuente 
                </li>
              </ul>
            </div>
          </div>
        </div>";

        $row = $resultado->fetch();
      }
    }
    echo "</div></div>";//añadimos un boton para ir a las noticias
    echo '<div class="col-12 d-flex justify-content-center"><a href="adminnoticias.php"><button class="btn btn-primary" type="button">Administrar noticias</button></a></div>';
  }
?>



<?php

if (!isset($error)) {
    $sql = "SELECT * FROM Foro ORDER BY IdForo DESC LIMIT 3";//obtenemos los 3 ultimos foros
    $resultado = $dwes->query($sql);
//generamos un bucle para cada foro y mostrar sus datos
    echo "<div class='container px-4 py-4' id='custom-cards'>
    <h2 class='pb-2 border-bottom'>Últimos temas</h2></div>";
    echo "<div class='container px-4 py-2' id='custom-cards'>";

    if ($resultado) {
      $row = $resultado->fetch();
      while ($row != null) {

        $id = $row['IdForo'];
        $fecha = $row['Fecha'];
        $titulo = $row['Titulo'];
        $descripcion = $row['Descripcion'];
        $icono = $row['Icono'];
        
          $sql2 = "SELECT count(*) as total FROM Entradas WHERE IdForo=". $id;//recogemos el numero de entradas de cada foro
          $resultado2 = $dwes->query($sql2);
          if ($resultado2 != null) {
            $row2 = $resultado2->fetch();
            while ($row2 != null) {
              $numentradas = $row2['total'];
              $row2 = $resultado2->fetch();
            }
          }

          echo "<h3 class='pb-1' style='color: black !important;'>$icono $titulo</h3><p>Fecha de creación: $fecha - Número de entradas: $numentradas</p><br>";

        
        $row = $resultado->fetch();
      }
      echo "</div>";//añadimos un boton para ir a los foros
      echo '<div class="mb-5 col-12 d-flex justify-content-center"><a href="adminforo.php"><button class="btn btn-primary" type="button">Administrar temas</button></a></div>';
    }
  }
?>
      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>

<?php echo $footer; ?>
    </body>
</html>