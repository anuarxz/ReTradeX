<?php
session_start();
if(isset($_SESSION['Admin']))
{
  if($_SESSION['Admin']==1)
  {
    header("Location: admin.php");
  } 
}else{
  header("Location: index.php");
}
include "global.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReTradeX - Perfil</title>
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
          echo '<a href="../Sesion/Iniciar.php"><button type="button" class="btn btn-outline-primary me-2 m-1">Iniciar Sesión</button></a>
          <a href="../Sesion/Registrarse.php"><button type="button" class="btn btn-primary m-1">Registrarse</button></a>';
        }else{
        echo '<a href="cerrarsesion.php"><button type="button" class="btn btn-outline-primary me-2 m-1">Cerrar Sesión</button></a>';
        }
        ?>
      </div>
    </header>
  </div>
 

  <div class="container px-3 py-5" id="custom-cards">
  <div class="row align-items-center">
      <div class="col">
        <h1 class="d-inline">Buenas, <?php echo $_SESSION['Nombre']; ?></h1>
      </div>
      <div class="col-auto">
        <a href="perfil.php"><button class="btn btn-outline-primary">Volver atrás</button></a>
      </div>
    </div>
  </div>


  
  <?php

include "global.php";

          if (isset($_POST['actualizar'])) {

          
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
            
            
                    $sql = "UPDATE Clientes SET 
                    Nombre = '$nombre',
                    Apellido = '$apellido',
                    Apodo = '$apodo',
                    Direccion = '$direccion',
                    Pais = '$pais',
                    CP = '$cp',
                    Correo = '$correo',
                    DNI = '$dni',
                    Telefono = '$telefono',
                    Clave = md5('$clave1')
                    WHERE IdCliente = " . $_SESSION['IdCliente'];
            
                    $dwes->query($sql);
            
                    unset($dwes);
            
                    $_SESSION['Nombre'] = $_REQUEST['nombre'];
                    $_SESSION['Apellido'] = $_REQUEST['apellido'];
                    $_SESSION['Apodo'] = $_REQUEST['apodo'];
                    $_SESSION['Direccion'] = $_REQUEST["direccion"];
                    $_SESSION['Pais'] = $_REQUEST["pais"];
                    $_SESSION['CP'] = $_REQUEST["cp"];
                    $_SESSION['Correo'] = $_REQUEST["correo"];
                    $_SESSION['DNI'] = $_REQUEST["dni"];
                    $_SESSION['Telefono'] = $_REQUEST["telefono"];
                    $_SESSION['Clave'] = $_REQUEST["clave1"];

                      echo "<div class='px-4 py-5 my-5 text-center'>
                      <img class='d-block mx-auto mb-4' src='../Imagenes/logo.png' alt='' width='72' height='57'>
                      <h1 class='display-5 fw-bold'>¡Genial!</h1>
                      <div class='col-lg-6 mx-auto'>
                        <p class='lead mb-4'>Se ha actualizado correctamente</p>
                        <div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>
                          <a href='perfil.php'><button type='button' class='btn btn-primary btn-lg px-4 gap-3'>Ver perfil</button></a>
                        </div>
                      </div>
                    </div>";
                    }
                      else {
          ?>

  <div class="container-md mt-2">
        <h2 class="text-center py-4">Editar perfil</h2>    

        <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" ENCTYPE="multipart/form-data" onsubmit='return formularioActualizar();'>
        <div class="col-md-4">
          <label class="form-label">Nombre</label>
          <input type="text" class="form-control" name="nombre" value="<?php echo $_SESSION['Nombre']; ?>" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Apellido</label>
          <input type="text" class="form-control" name="apellido" value="<?php echo $_SESSION['Apellido']; ?>" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Apodo</label>
          <div class="input-group">
            <span class="input-group-text">@</span>
            <input type="text" class="form-control" name="apodo" value="<?php echo $_SESSION['Apodo']; ?>" required>
          </div>
        </div>
        <div class="col-md-6">
          <label class="form-label">Dirección</label>
          <input type="text" class="form-control" name="direccion"  value="<?php echo $_SESSION['Direccion']; ?>" required>
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
          <input type="text" class="form-control" name="cp" value="<?php echo $_SESSION['CP']; ?>" required>
        </div>



        <div class="col-md-6">
          <label class="form-label">Correo electrónico</label>
          <input type="text" class="form-control" name="correo" value="<?php echo $_SESSION['Correo']; ?>" required>
        </div>
        <div class="col-md-3">
          <label  class="form-label">DNI/NIE</label>
          <input type="text" class="form-control" name="dni" value="<?php echo $_SESSION['DNI']; ?>" required>
        </div>
        <div class="col-md-3">
          <label class="form-label">Teléfono</label>
          <input type="text" class="form-control" name="telefono" value="<?php echo $_SESSION['Telefono']; ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Nueva contraseña</label>
          <input type="password" class="form-control" name="clave1" required>
          </div>
          <div class="col-md-6">
          <label class="form-label">Repetir contraseña</label>
          <input type="password" class="form-control" name="clave2" required>
          </div>

<div class="text-center" style="color:red;" id="info"></div>

<div class="col-12 d-flex justify-content-center py-3">
  <button class="btn btn-primary" name="actualizar" type="submit">Actualizar</button>
</div>

      </form>

      <script>

function formularioActualizar() {
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
  var regex_dni = /^\d{8}[a-zA-Z]$/;
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
  

      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
      <?php echo $footer; ?>
    </body>
</html>