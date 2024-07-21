<?php
session_start();
include "global.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReTradeX - Política de privacidad</title>
    <link rel="icon" type="image/jpg" href="../Imagenes/logo.png"/>
    <link rel="stylesheet" href="../Estilos/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
        <li class="nav-item"><a href="tienda.php" class="nav-link px-2 link-dark">Tienda</a></li>
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
 

 

  <div class="container px-4 py-5" id="custom-cards">
  <div class="row align-items-center">
      <div class="col">
        <h1 class="d-inline">Contactar</h1>
      </div>
    </div>
  </div>


  <?php

include "global.php";

          if (isset($_POST['contactar'])) {

            date_default_timezone_set('Europe/Madrid');
            $fechaHoraActual = date('Y-m-d H:i:s');

            $nombre = $_REQUEST['nombre'];
            $apellido = $_REQUEST['apellido'];
            $direccion = $_REQUEST['direccion'];
            $correo = $_REQUEST['correo'];
            $telefono = $_REQUEST['telefono'];
            $descripcion = $_REQUEST['descripcion'];   
            
            
                    $sql = "INSERT INTO Contacto(Fecha, Nombre, Apellido, Direccion, Correo, Telefono, Descripcion) VALUES  
                    ('$fechaHoraActual', '$nombre', '$apellido', '$direccion', '$direccion', '$correo', '$telefono', '$descripcion');";

                    $dwes->query($sql);
            
                    unset($dwes);
            
                      echo "<div class='px-4 py-5 my-5 text-center'>
                      <img class='d-block mx-auto mb-4' src='../Imagenes/logo.png' alt='' width='72' height='57'>
                      <h1 class='display-5 fw-bold'>¡Genial!</h1>
                      <div class='col-lg-6 mx-auto'>
                        <p class='lead mb-4'>Se ha enviado correctamente</p>
                        <div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>
                          <a href='index.php'><button type='button' class='btn btn-primary btn-lg px-4 gap-3'>Página principal</button></a>
                        </div>
                      </div>
                    </div>";
                    }
                      else {
          ?>

  <div class="container-md mt-2">
        <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" ENCTYPE="multipart/form-data" onsubmit='return formularioContacto();'>
        <div class="col-md-4">
          <label class="form-label">Nombre</label>
          <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Apellido</label>
          <input type="text" class="form-control" name="apellido" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Teléfono</label>
          <input type="text" class="form-control" name="telefono" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Dirección</label>
          <input type="text" class="form-control" name="direccion" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Correo electrónico</label>
          <input type="text" class="form-control" name="correo" required>
        </div>
        <div class="col-md-12">
          <label class="form-label">Descripcion</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" name="descripcion" rows="5"></textarea>
        </div>
<div class="text-center" style="color:red;" id="info"></div>

<div class="col-12 d-flex justify-content-center py-5">
  <button class="btn btn-primary" name="contactar" type="submit">Contactar</button>
</div>

      </form>

        <?php
    }
    ?>
             
<script>

function formularioContacto() {
  var nombre = document.getElementsByName("nombre")[0].value;
  var apellidos = document.getElementsByName("apellido")[0].value;
  var direccion = document.getElementsByName("direccion")[0].value;
  var correo = document.getElementsByName("correo")[0].value;
  var telefono = document.getElementsByName("telefono")[0].value;
  var descripcion = document.getElementsByName("descripcion")[0].value;

  var regex_nombre = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,30}$/;
  var regex_apellidos = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,40}$/;
  var regex_direccion =  /^[a-zA-Z0-9ªº, ]{3,50}$/;
  var regex_correo = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;
  var regex_telefono = /^\d{6,9}$/;
  var regex_descripcion =  /^[a-zA-Z0-9ªº, ]{3,200}$/;


  var info = document.getElementById("info");

  var validado = true;

  if (!regex_nombre.test(nombre)) {
    info.innerHTML = "El nombre debe tener entre 3 y 30 letras.";
    validado = false;
  } else if (!regex_apellidos.test(apellidos)) {
    info.innerHTML = "Los apellidos deben tener entre 3 y 40 letras.";
    validado = false;
  }  else if (!regex_direccion.test(direccion)) {
    info.innerHTML = "La dirección debe tener entre 3 y 50 letras.";
    validado = false;
  } else if (!regex_correo.test(correo)) {
    info.innerHTML = "El correo electrónico no es válido.";
    validado = false;
  } else if (!regex_telefono.test(telefono)) {
    info.innerHTML = "El teléfono debe tener entre 6 y 9 dígitos.";
    validado = false;
  } else if (!regex_descripcion.test(descripcion)) {
    info.innerHTML = "La descripción debe tener entre 3 y 200 letras.";
    validado = false;
  } 

  if (validado) {
    return true;
  } else {
    return false;
  }
}

</script>

    <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
<?php echo $footer; ?>
    </body>
</html>