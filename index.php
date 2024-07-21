<?php
session_start();
if(isset($_SESSION['Admin'])) //Comprobamos si existe la sesión Admin
{
  if($_SESSION['Admin']==1) //Si es Admin lo devolvemos a admin.php
  {
    header("Location: admin.php");
  } 
}
include "global.php"; //Añadimos la conexión a la base de datos
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReTradeX - Inicio</title>
    <link rel="icon" type="image/jpg" href="../Imagenes/logo.png"/>
    <link rel="stylesheet" href="../Estilos/style.css">
</head>
<body>
<!-- Añadimos el menú con los enlaces a la diferentes páginas -->
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-2">
      <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="img-fluid" src="../Imagenes/logo.png" height="75px" width="75px">
      </a>

      <ul class="nav nav-pills col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a href="index.php" class="nav-link px-2 link-dark active">Inicio</a></li>
        <li class="nav-item"><a href="mercado.php" class="nav-link px-2 link-dark">Mercado</a></li>
        <li class="nav-item"><a href="noticias.php" class="nav-link px-2 link-dark">Noticias</a></li>
        <li class="nav-item"><a href="foro.php" class="nav-link px-2 link-dark">Foro</a></li>
        <li class="nav-item"><a href="tienda.php" class="nav-link px-2 link-dark">Tienda</a></li>
      </ul>

      <div class="col-md-3 text-end">
      <?php
        if (!isset($_SESSION['correo'])) { //Dependiendo de si ha inciado sesión o no ponemos unos botones u otros
          echo '<a href="iniciar.php"><button type="button" class="btn btn-outline-primary me-2 m-1">Iniciar Sesión</button></a>
          <a href="registro.php"><button type="button" class="btn btn-primary m-1">Registrarse</button></a>';
        }else{
        echo '<a href="perfil.php"><button type="button" class="btn btn-primary m-1">Saldo '.$_SESSION['Saldo'].'€</button></a>
        <a href="cerrarsesion.php"><button type="button" class="btn btn-outline-primary me-2 m-1">Cerrar Sesión</button></a>';
        }
        ?>
      </div>
    </header>
  </div>

  <!-- Añadimos un carrusel de fotos usando Bootstrap 5-->
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../Imagenes/banner1.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../Imagenes/banner2.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../Imagenes/banner3.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previo</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>


<?php

if (!isset($error)) { //Si no hay error en la base de datos seguimos
      echo "<div class='container px-4 py-5' id='custom-cards'>
      <h2 class='pb-2 border-bottom'>Noticias destacadas</h2>
      <div class='row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-4'>"; //Creamos un div para los elementos del bucle

      $sql2 = "SELECT * FROM Noticias ORDER BY IdNoticia DESC LIMIT 3"; //Hacemos la consulta obteniendo las 3 últimas noticias
      $resultado2 = $dwes->query($sql2);
      $row2 = $resultado2->fetch();
      while ($row2 != null) {
        //Obtenemos los datos de las noticias
        $nombre = $row2['Titulo'];
        $foto = $row2['Foto'];
        $fuente = $row2['Fuente'];
        $id = $row2["IdNoticia"];

        echo "<div class='col zoom'>
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
      </div>"; //Generemos un div para cada noticia con sus datos y un botón

        $row2 = $resultado2->fetch();
      }
      echo "</div></div>";    
  }

?>
  
  <div class="container my-5 mt-0">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
          <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fw-bold lh-1">Disfruta de las mejores comisiones</h1>
            <p class="lead">En ReTradeX te ofrecemos una gran variedad de activos y servicios exclusivos, al 0% de comisiones de mantenimiento!</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
              <a href="mercado.php"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">Ver mercado</button></a>
            </div>
          </div>
          <div class="col-lg-4 offset-lg-1 p-0 shadow-lg">
              <img class="rounded img-fluid" src="../Imagenes/0.png" alt="" >
          </div>
        </div>
      </div>


<?php

  
if (!isset($error)) {
  $sql = "SELECT * FROM Productos LIMIT 3";
  $resultado = $dwes->query($sql);

  echo "<div class='container px-4 py-4' id='custom-cards'>
  <h2 class='pb-2 border-bottom'>Productos destacados</h2>
  <div class='row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-4'>";
  
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
              <li class='d-flex align-items-center me-2'>
                <a href='producto.php?IdProducto=$id'><button type='button' class='btn btn-danger'>Comprar</button></a>
              </li>
            </ul>
          </div>
        </div>
      </div>";


      $row = $resultado->fetch();
    }

    echo "</div></div>";

  }
}


?>



      

      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="bootstrap" viewBox="0 0 118 94">
          <title>Bootstrap</title>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
        </symbol>
        <symbol id="casa" viewBox="0 0 16 16">
          <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
        </symbol>
        <symbol id="mundo" viewBox="0 0 16 16">
          <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z"/>
        </symbol>
        <symbol id="info" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
          <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>        </symbol>
        <symbol id="persona" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>        </symbol>
        <symbol id="tiempo" viewBox="0 0 16 16">
          <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
          <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>        </symbol>
        <symbol id="variedad" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 0 .5Zm0 2A.5.5 0 0 1 .5 2h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm9 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm-9 2A.5.5 0 0 1 .5 4h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Zm5 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm7 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Zm-12 2A.5.5 0 0 1 .5 6h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm8 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm-8 2A.5.5 0 0 1 .5 8h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm7 0a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm-7 2a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5Zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Z"/>
        </symbol>
        <symbol id="seguridad" viewBox="0 0 16 16">
          <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
        </symbol>
        <symbol id="soporte" viewBox="0 0 16 16">
          <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm5 4a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
        </symbol>
      </svg>

      <div class="container px-4 py-5" id="icon-grid">
        <h2 class="pb-2 border-bottom">Ventajas</h2>
    
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
          <div class="col d-flex align-items-start">
            <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#casa"/></svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4">Comodidad</h3>
              <p>Puedes comprar nuestros servicios desde la comodidad de tu hogares.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start">
            <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#mundo"/></svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4">Accesibilidad</h3>
              <p>Accede a este sitio web desde cualquier lugar y en cualquier momento.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start">
            <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#info"/></svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4">Información</h3>
              <p>Siempre tendrás toda la información bien detallada y clara, al alcance de tu mano.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start">
            <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#persona"/></svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4">Personalización</h3>
              <p>Nuestros servicios siempre estarán personalizados a su gusto.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start">
            <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#tiempo"/></svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4">Ahorro de tiempo</h3>
              <p>No sólo ahorrarás dinero sino que también tiempo.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start">
            <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#variedad"/></svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4">Variedad</h3>
              <p>Ofrecemos una gran variedad de servicios que puedes escoger a tu gusto.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start">
            <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#seguridad"/></svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4">Seguridad</h3>
              <p>Contamos con la mejor seguridad y privacidad.</p>
            </div>
          </div>
          <div class="col d-flex align-items-start">
            <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#soporte"/></svg>
            <div>
              <h3 class="fw-bold mb-0 fs-4">Soporte</h3>
              <p>Tenemos soporte en línea las 24h del día.</p>
            </div>
          </div>
        </div>
      </div>

  


      

      <div class="container col-xxl-8 px-4 py-0">
        <div class="row flex-lg-row-reverse align-items-center g-2 py-0">
          <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">¿Quiénes somos?</h1>
            <p class="lead">Un bróker profesional homologado con sede en Almería. Nos especializamos en ofrecer activos y valores del mercado para usuarios y empresas de todos los tamaños y sectores.</p>
          </div>
          <div class="col-10 col-sm-8 col-lg-6">
            <img src="../Imagenes/logo.png" class="d-block mx-lg-auto img-fluid">
          </div>
        </div>
      </div>

<br><br>


      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
      <?php echo $footer; ?> <!-- Añadimos el footer mediante el include -->
</body>
</html>