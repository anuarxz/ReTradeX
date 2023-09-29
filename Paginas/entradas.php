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

if (isset($_POST['insertar'])) {    
  $entrada = $_REQUEST['entrada'];
  $sql = "INSERT INTO Entradas(Fecha, Texto, IdForo, IdCliente) VALUES  
          ('hoy', '$entrada', '".$_GET['IdForo']."', '".$_SESSION['IdCliente']."');";
  $dwes->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReTradeX - Noticias</title>
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
        <li class="nav-item"><a href="foro.php" class="nav-link px-2 link-dark active">Foro</a></li>
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
 
<?php
  $id = $_GET['IdForo'];

  if (!isset($error)) {
    $sql = "SELECT * FROM Foro WHERE IdForo = $id";
    $resultado = $dwes->query($sql);
    
    if ($resultado) {
      $row = $resultado->fetch();
      while ($row != null) {

          $fecha = $row['Fecha'];
          $titulo = $row['Titulo'];
          $descripcion = $row['Descripcion'];
          $icono = $row['Icono'];

          echo "<div class='container px-3 py-5 mb-0' id='custom-cards'>
                <div class='row align-items-center'>
                  <div class='col'>
                    <h1 class='d-inline'>Foro <span class='h2 d-inline'>- $icono $titulo</span></h1>
                  <hr>
                  <div class='d-flex align-items-center'>
                        <textarea class='form-control' id='comment1' rows='2' disabled>$descripcion</textarea>
                      </div>
                    </div>
                </div>
              </div>";


        $row = $resultado->fetch();
      }
    }
  }

?>


<div class='container'>
  <div class='row'>
    <div class='col'>

    <?php

if (!isset($error)) {
  $sql = "SELECT * FROM Entradas WHERE IdForo = $id";
  $resultado = $dwes->query($sql);
  $contador = 0;
  
  if ($resultado) {
    $row = $resultado->fetch();
    while ($row != null) {

        $fecha = $row['Fecha'];
        $texto = $row['Texto'];
        $IdCliente = $row['IdCliente'];
      

        $sql2 = "SELECT * FROM Clientes WHERE IdCliente = $IdCliente";
        $resultado2 = $dwes->query($sql2);
        
        if ($resultado2) {
          $row2 = $resultado2->fetch();
          while ($row2 != null) {
            $Apodo = $row2['Apodo'];
            $row2 = $resultado2->fetch();
          }
        }

        if ($contador % 2 == 0) {
          echo "<div class='mb-3'>
                <div class='d-flex align-items-center'>
                  <label for='comment1' class='form-label mr-2 mx-2'>$Apodo</label>
                  <textarea class='form-control' id='comment1' rows='3'>$texto</textarea>
                </div>
              </div>";
        } else {
          echo "<div class='mb-3'>
                <div class='d-flex align-items-center'>
                  <textarea class='form-control' id='comment1' rows='3'>$texto</textarea>
                  <label for='comment1' class='form-label mr-2 mx-2'>$Apodo</label>
                </div>
              </div>";
        }

        $row = $resultado->fetch();
        $contador++;
    }
  }
}
?>



    </div>
  </div>
</div>


<form action="<?php echo $_SERVER['PHP_SELF'] . "?IdForo=". $id; ?>" method="post" ENCTYPE="multipart/form-data">
  <div id='entriesContainer' class='container'>
    <!-- Aquí se mostrarán las entradas añadidas dinámicamente -->
  </div>
  <div class='container text-center py-3' id='saveBtn' style='display: none;'>
    <button type='submit' class='btn btn-primary mt-5' name='insertar'>Guardar</button>
    <div id="warning" style="color: red; display: none;"><br>El campo de texto está vacío. Por favor, añade una entrada.</div>
  </div>
</form>

<?php
if (isset($_SESSION['correo'])) {
  echo "<div class='container text-center py-3'>
        <button type='button' class='btn btn-primary' id='addEntryBtn' name='entrada'>Añadir entrada</button>
      </div>";
} else {
  echo "<div class='container text-center py-3'>
             <a href='iniciar.php'><button type='button' class='btn btn-primary mb-5'>Inicia sesión o regístrate para añadir entradas</button></a>
        </div>";
}
?>

<script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script>
  var addEntryBtn = document.getElementById('addEntryBtn');
  var saveBtn = document.getElementById('saveBtn');
  var warning = document.getElementById('warning');

  addEntryBtn.addEventListener('click', function() {
    var newEntryDiv = document.createElement('div');
    newEntryDiv.classList.add('mb-3');
    newEntryDiv.innerHTML = `
      <div class="d-flex justify-content-end align-items-center">
        <textarea class="form-control" rows="3" name='entrada' required></textarea>
        <label class="form-label m-2"> <?php echo $_SESSION['Apodo']; ?></label>
      </div>
    `;
    var entriesContainer = document.getElementById('entriesContainer');
    entriesContainer.appendChild(newEntryDiv);

    addEntryBtn.style.visibility = 'hidden'; // Oculta el botón "Añadir entrada"
    saveBtn.style.display = 'block'; // Muestra el botón "Guardar"
  });

  saveBtn.addEventListener('click', function(e) {
    var textarea = document.querySelector('textarea[name="entrada"]');
    if (textarea.value.trim() === '') {
      e.preventDefault(); // Evita enviar el formulario
      warning.style.display = 'block'; // Muestra la advertencia
    } else {
      warning.style.display = 'none'; // Oculta la advertencia si el campo no está vacío
    }
  });
</script>

<?php echo $footer; ?>
    </body>
</html>