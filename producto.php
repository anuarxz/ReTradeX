<?php
session_start();
if(isset($_SESSION['Admin']))
{
  if($_SESSION['Admin']==1)
  {
    header("Location: admin.php");
  } 
}
include "global.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReTradeX - Comprar</title>
    <link rel="icon" type="image/jpg" href="../Imagenes/logo.png"/>
    <link rel="stylesheet" href="../Estilos/style.css">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    filter: brightness(50%) !important; /* Ajusta el valor para cambiar la intensidad del gris */
  }
</style>
</head>
<body>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-2">
      <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="img-fluid" src="../Imagenes/logo.png" height="75px" width="75px">
      </a>

      <ul class="nav nav-pills col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a href="index.php" class="nav-link px-2 link-dark">Inicio</a></li>
        <li class="nav-item"><a href="mercado.php" class="nav-link px-2 link-dark">Mercado</a></li>
        <li class="nav-item"><a href="noticias.php" class="nav-link px-2 link-dark">Noticias</a></li>
        <li class="nav-item"><a href="foro.php" class="nav-link px-2 link-dark">Foro</a></li>
        <li class="nav-item"><a href="tienda.php" class="nav-link px-2 link-dark active">Tienda</a></li>
      </ul>
      <div class="col-md-3 text-end">
      <?php
        if (!isset($_SESSION['correo'])) {
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
         
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" ENCTYPE="multipart/form-data">

  <?php

if(isset($_GET['IdProducto'])){
    $_SESSION['IdProducto'] = $_GET['IdProducto'];
}

if (isset($_POST['comprar'])) {
  date_default_timezone_set('Europe/Madrid');
  $fechaHoraActual = date('Y-m-d H:i:s');

  $cantidad = $_REQUEST['cantidad'];
  $preciopro = $_REQUEST['precio'];

  
          $sql = "INSERT INTO Compras(Fecha, Cantidad, IdProducto, IdCliente) VALUES  
          ('$fechaHoraActual', '$cantidad', '".$_SESSION['IdProducto']."', '".$_SESSION['IdCliente']."');";

          $dwes->query($sql);
  
          $_SESSION['Saldo'] = $_SESSION['Saldo'] - ($cantidad * $preciopro);

          $sql = "UPDATE Clientes SET Saldo = '".$_SESSION['Saldo']."' WHERE IdCliente =" .$_SESSION['IdCliente'];
  
          $dwes->query($sql);
  
          unset($dwes);
  
            echo "<div class='px-4 py-5 my-5 text-center'>
            <img class='d-block mx-auto mb-4' src='../Imagenes/logo.png' alt='' width='72' height='57'>
            <h1 class='display-5 fw-bold'>¡Genial!</h1>
            <div class='col-lg-6 mx-auto'>
              <p class='lead mb-4'>Se ha realizado la compra correctamente</p>
              <div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>
                <a href='tienda.php'><button type='button' class='btn btn-primary btn-lg px-4 gap-3'>Ver tienda</button></a>
                <a href='perfil.php'><button type='button' class='btn btn-primary btn-lg px-4 gap-3'>Ver perfil</button></a>
              </div>
            </div>
          </div>";
          }
            else {



if (!isset($_SESSION['correo'])) {
  $boton = '<button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-title="Regístrate o inicia sesión para poder comprar" style="width: 100% !important;"> 
              Comprar artículo
          </button>';
}else{
    $boton = '<button type="submit" id="boton-comprar" name="comprar" class="btn btn-primary" style="width: 100%;">Comprar artículo</button>';
}
    
        if (!isset($error)) {
  

          $sql = "SELECT * FROM Productos WHERE IdProducto= " . $_SESSION['IdProducto'];
          $resultado = $dwes->query($sql);
          if ($resultado) {
              $row = $resultado->fetch();
              while ($row != null) {
                $nombre = $row['Nombre'];
                $precio = $row['Precio'];
                $descripcion = $row['Descripcion'];
                $foto1 = $row["Foto1"];
                $foto2 = $row["Foto2"];
                $foto3 = $row["Foto3"];
                $foto4 = $row["Foto4"];
  
                  echo "  <div class='container px-3 py-3' id='custom-cards'>
                  <div class='row align-items-center'>
                      <div class='col'>
                        <h1 class='d-inline'>$nombre</h1>
                      </div>
                      </div>
                    </div>
                
                
                  <div class='container px-4 py-3' id='custom-cards'>
                  <div class='row'>
                      <div class='col'>
                
                      <div id='carouselExampleAutoplaying' class='carousel slide' data-bs-ride='carousel'>
                        <div class='carousel-inner'>
                            <div class='carousel-item active'>
                            <img src='$foto1' class='d-block w-100 img-fluid rounded' alt='...'>
                            </div>
                            <div class='carousel-item'>
                            <img src='$foto2' class='d-block w-100 img-fluid rounded' alt='...'>
                            </div>
                            <div class='carousel-item'>
                            <img src='$foto3' class='d-block w-100 img-fluid rounded' alt='...'>
                            </div>
                            <div class='carousel-item'>
                            <img src='$foto4' class='d-block w-100 img-fluid rounded' alt='...'>
                            </div>
                        </div>
                        <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleAutoplaying' data-bs-slide='prev'>
                            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                            <span class='visually-hidden'>Previous</span>
                        </button>
                        <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleAutoplaying' data-bs-slide='next'>
                            <span class='carousel-control-next-icon' aria-hidden='true'></span>
                            <span class='visually-hidden'>Next</span>
                        </button>
                        </div>
                
                      </div>
                
                
                        <div class='col d-flex flex-column align-items-start px-5'>
                        <h3 class='mb-4'>$nombre ReTradeX</h3>
                        <p>$descripcion</p>    
                
                
                        <div class='input-group mt-3'>
                        <div class='btn btn-primary' style='pointer-events: none;'><i class='bi bi-tag'></i></div>                        
                            <input type='text' class='form-control' value='$precio €' disabled>
                            <input type='hidden' name='precio' class='form-control' value='$precio'>
                        </div>
                        <div class='input-group mt-3'>
                            <input type='number' id='cantidad' name='cantidad' class='form-control' placeholder='Cantidad' min='1'>
                        </div>
                        <div class='input-group mt-3'>
                            $boton
                        </div>

                        <div id='errorcantidad' class='toast align-items-center text-bg-primary fade mt-5 show' role='alert' aria-live='assertive' aria-atomic='true' style='margin-left: auto; margin-right: auto; display: none;'>
                        <div class='d-flex'>
                          <div class='toast-body'>
                            <i class='bi bi-exclamation-circle'></i> &nbsp;&nbsp;¡Valor incorrecto o no tiene suficiente saldo!
                          </div>
                        </div>
                      </div>

                        </div>
                  </div>
                  </div>";
                      
                  $row = $resultado->fetch();
              }}
  
        };
    


        
        if (!isset($error)) {
          $sql = "SELECT * FROM Productos WHERE IdProducto!=". $_SESSION['IdProducto'] ." LIMIT 3";
          $resultado = $dwes->query($sql);
      
          echo "  <div class='container px-4 py-3 mt-5' >
          <div class='row align-items-center'>
              <div class='col'>
                <h3 class='text-center'>Productos destacados</h3>
              </div>
            </div>
          </div><div class='container px-4 py-2 pb-5' id='custom-cards'>
          <div class='row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3'>";
          
          if ($resultado) {
            $row = $resultado->fetch();
            while ($row != null) {
      
                $id = $row['IdProducto'];
                $nombre = $row['Nombre'];
                $preciomuestra = $row['Precio'];
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
                      $preciomuestra €
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


</form>

<div class="container px-4" id="custom-cards">
  <div class="d-flex justify-content-between">
    <a href="tienda.php"><button type="button" class="btn btn-outline-primary"><i class="bi bi-arrow-90deg-left"></i> Volver atrás</button></a>
    <?php
              $sql = "SELECT * FROM Productos WHERE IdProducto=" . ($_SESSION['IdProducto'] + 1) . ";";
              $resultado = $dwes->query($sql);
              if ($resultado) {
                $row = $resultado->fetch();
                if($row != null) {
                echo "<a href='producto.php?IdProducto=".($_SESSION['IdProducto']+1)."'><button type='button' class='btn btn-primary'>Siguiente producto <i class='bi bi-arrow-right'></i></button></a>";
                }
             }  
?>
  </div>
</div>



<script>
  var saldo =<?php echo $_SESSION['Saldo'];?>;
  var precio =<?php echo $precio;?>;
  </script>

  <script>
(() => {
  'use strict'
  document.querySelectorAll('[data-bs-toggle="tooltip"]')
    .forEach(tooltip => {
      new bootstrap.Tooltip(tooltip)
    })

})()


document.querySelector('form').addEventListener('submit', function(event) {
  var errorDiv = document.getElementById('errorcantidad');
  var cantidadInput = document.getElementById('cantidad');
  var cantidad = parseInt(cantidadInput.value);
  var x = saldo / precio;
  console.log(x+" es " +saldo +" es " +cantidad);

  if (cantidadInput.value.trim() === '' || cantidad <= 0 || cantidad > x) {
    event.preventDefault();
    errorDiv.style.display = 'block';
  }
});


  </script>

<script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
      <?php } echo $footer; ?>
</body>
</html>