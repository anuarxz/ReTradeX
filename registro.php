<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReTradeX - Registro</title>
    <link rel="icon" type="image/jpg" href="../Imagenes/logo.png"/>
    <link rel="stylesheet" href="../Estilos/style.css">
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
    </header>
  </div>

  <div class="toast align-items-center text-bg-primary fade show" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left: auto; margin-right: auto;">
  <div class="d-flex">
    <div class="toast-body">
      ¡Regístrate ahora y obtén un bono de 50€!
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>



      <?php

include "global.php";

          if (isset($_POST['registro'])) {

          
            $nombre = $_REQUEST['nombre'];
            $apellido = $_REQUEST['apellido'];
            $apodo = $_REQUEST['apodo'];
            $direccion = $_REQUEST['direccion'];
            $pais = $_REQUEST['pais'];
            $cp = $_REQUEST['cp'];
            $dni = $_REQUEST['dni'];
            $correo = $_REQUEST['correo'];
            $telefono = $_REQUEST['telefono'];
            $clave1 = $_REQUEST['clave1'];
            $clave2 = $_REQUEST['clave2'];   
            
            
                    $sql = "INSERT INTO Clientes(Nombre, Apellido, Apodo, Direccion, Pais, CP, Correo, DNI, Telefono, Clave, Saldo) VALUES  
                    ('$nombre', '$apellido', '$apodo', '$direccion', '$pais', '$cp', '$correo', '$dni', '$telefono', md5('$clave1'), 50);";

                    $dwes->query($sql);
            
                    unset($dwes);
            
                      echo "<div class='px-4 py-5 my-5 text-center'>
                      <img class='d-block mx-auto mb-4' src='../Imagenes/logo.png' alt='' width='72' height='57'>
                      <h1 class='display-5 fw-bold'>¡Genial!</h1>
                      <div class='col-lg-6 mx-auto'>
                        <p class='lead mb-4'>Se ha registrado correctamente</p>
                        <div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>
                          <a href='iniciar.php'><button type='button' class='btn btn-primary btn-lg px-4 gap-3'>Iniciar sesión</button></a>
                        </div>
                      </div>
                    </div>";
                    }
                      else {
          ?>
      
      <div class="container-md mt-2">
        <h2 class="text-center py-4">Formulario de registro</h2>    

        <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" ENCTYPE="multipart/form-data" onsubmit='return formularioRegistro();'>
        <div class="col-md-4">
          <label class="form-label">Nombre</label>
          <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Apellido</label>
          <input type="text" class="form-control" name="apellido" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Apodo</label>
          <div class="input-group">
            <span class="input-group-text">@</span>
            <input type="text" class="form-control" name="apodo" required>
          </div>
        </div>
        <div class="col-md-6">
          <label class="form-label">Dirección</label>
          <input type="text" class="form-control" name="direccion" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">País</label>
          <select class="form-select" name="pais">
            <option value="España" selected>España</option>
            <option value="Portugal">Portugal</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">C.P.</label>
          <input type="text" class="form-control" name="cp" required>
        </div>



        <div class="col-md-6">
          <label class="form-label">Correo electrónico</label>
          <input type="text" class="form-control" name="correo" required>
        </div>
        <div class="col-md-3">
          <label  class="form-label">DNI/NIE</label>
          <input type="text" class="form-control" name="dni" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Teléfono</label>
          <input type="text" class="form-control" name="telefono" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="clave1" required>
          </div>
          <div class="col-md-6">
          <label class="form-label">Repetir contraseña</label>
          <input type="password" class="form-control" name="clave2" required>
          </div>

          <div class="col-12 d-flex justify-content-center">
  <div class="form-check">
    <input class="form-check-input" type="checkbox" required>
    <label class="form-check-label">
      Acepta los términos y condiciones
    </label>
  </div>
</div>
<a class='text-center' href="iniciar.php">¿Ya estás registrado? Inicia sesión</a>
<div class="text-center" style="color:red;" id="info"></div>

<div class="col-12 d-flex justify-content-center">
  <button class="btn btn-primary" name="registro" type="submit">Registrarse</button>
</div>

      </form>
        
<script>

function formularioRegistro() {
  var nombre = document.getElementsByName("nombre")[0].value;
  var apellidos = document.getElementsByName("apellido")[0].value;
  var apodo = document.querySelector('input[name="apodo"]').value;
  var direccion = document.getElementsByName("direccion")[0].value;
  var cp = document.getElementsByName("cp")[0].value;
  var correo = document.getElementsByName("correo")[0].value;
  var dni = document.getElementsByName("dni")[0].value;
  var telefono = document.getElementsByName("telefono")[0].value;
  var clave1 = document.getElementsByName("clave1")[0].value;
  var clave2 = document.getElementsByName("clave2")[0].value;

  var regex_nombre = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,30}$/;
  var regex_apellidos = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,40}$/;
  var regex_apodo = /^[a-zA-Z0-9]{3,10}$/;
  var regex_direccion =  /^[a-zA-Z0-9ªº, ]{3,50}$/;
  var regex_cp = /^\d{5}$/;
  var regex_correo = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/;
  var regex_dni = /^([XYZxyz]\d{7,8}|[0-9]{8})[A-Za-z]$/;
  var regex_telefono = /^\d{6,9}$/;

  var info = document.getElementById("info");

  var validado = true;

  if (!regex_nombre.test(nombre)) {
    info.innerHTML = "El nombre debe tener entre 3 y 30 letras.";
    validado = false;
  } else if (!regex_apellidos.test(apellidos)) {
    info.innerHTML = "Los apellidos deben tener entre 3 y 40 letras.";
    validado = false;
  } else if (!regex_apodo.test(apodo)) {
    info.innerHTML = "El apodo debe tener entre 3 y 10 letras.";
    validado = false;
  } else if (!regex_direccion.test(direccion)) {
    info.innerHTML = "La dirección debe tener entre 3 y 50 letras.";
    validado = false;
  } else if (!regex_cp.test(cp)) {
    info.innerHTML = "El código postal debe tener 5 dígitos.";
    validado = false;
  } else if (!regex_correo.test(correo)) {
    info.innerHTML = "El correo electrónico no es válido.";
    validado = false;
  } else if (!regex_dni.test(dni)) {
    info.innerHTML = "El DNI/NIE no es válido.";
    validado = false;
  } else if (!regex_telefono.test(telefono)) {
    info.innerHTML = "El teléfono debe tener entre 6 y 9 dígitos.";
    validado = false;
  } else if (clave1 !== clave2 || clave1 === '') {
    info.innerHTML = "Las contraseñas deben coincidir y no estar vacías.";
    validado = false;
  }

  if (validado) {
    return true;
  } else {
    return false;
  }
}

</script>

        <?php
    }
    ?>
  

      </div>


<br>
      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
      <?php echo $footer; ?>
</body>
</html>