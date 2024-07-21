<?php
session_start();
if($_SESSION['Admin']!=1)
{
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
    <title>ReTradeX - Administracion</title>
    <link rel="icon" type="image/jpg" href="../Imagenes/logo.png"/>
    <link rel="stylesheet" href="../Estilos/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-2">
      <a href="admin.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="img-fluid" src="../Imagenes/logo.png" height="75px" width="75px">
      </a>

      <ul class="nav nav-pills col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a href="admin.php" class="nav-link px-2 link-dark">General</a></li>
        <li class="nav-item"><a href="adminclientes.php" class="nav-link px-2 link-dark">Clientes</a></li>
        <li class="nav-item"><a href="adminnoticias.php" class="nav-link px-2 link-dark">Noticias</a></li>
        <li class="nav-item"><a href="adminforo.php" class="nav-link px-2 link-dark">Foro</a></li>
        <li class="nav-item"><a href="admintienda.php" class="nav-link px-2 link-dark active">Tienda</a></li>
      </ul>
      <div class="col-md-3 text-end">
        <a href="cerrarsesion.php"><button type="button" class="btn btn-outline-primary me-2 m-1">Cerrar Sesión</button></a>
      </div>
    </header>
  </div>

  
  <div class="container px-3 py-5" id="custom-cards">
  <div class="row align-items-center">
      <div class="col">
        <h1 class="d-inline">Añadir producto</h1>
      </div>
    </div>
  </div>

  <?php
          if (isset($_POST['añadir'])) {

            date_default_timezone_set('Europe/Madrid');
            $fechaHoraActual = date('Y-m-d H:i:s');

            $foto = "";
            $foto1 = "";
            $foto2 = "";
            $foto3 = "";
            $foto4 = "";

          if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
            $allowed_mime_types = array('image/jpeg', 'image/png', 'image/jpg', 'image/gif'); // tipos MIME permitidos
            $filename = $_FILES['foto']['tmp_name']; // obtener nombre temporal del archivo
            $file_type = mime_content_type($filename); // obtener tipo MIME del archivo

            if (in_array($file_type, $allowed_mime_types)) {
                // El archivo es una imagen jpeg o png
                $nombreDirectorio = '../Imagenes/';
                $foto = $nombreDirectorio . $_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
            } 
        }

        if (is_uploaded_file($_FILES['foto1']['tmp_name'])) {
            $allowed_mime_types = array('image/jpeg', 'image/png', 'image/jpg', 'image/gif'); // tipos MIME permitidos
            $filename = $_FILES['foto1']['tmp_name']; // obtener nombre temporal del archivo
            $file_type = mime_content_type($filename); // obtener tipo MIME del archivo

            if (in_array($file_type, $allowed_mime_types)) {
                // El archivo es una imagen jpeg o png
                $nombreDirectorio = '../Imagenes/';
                $foto = $nombreDirectorio . $_FILES['foto1']['name'];
                move_uploaded_file($_FILES['foto1']['tmp_name'], $foto);
            } 
        }
        if (is_uploaded_file($_FILES['foto2']['tmp_name'])) {
            $allowed_mime_types = array('image/jpeg', 'image/png', 'image/jpg', 'image/gif'); // tipos MIME permitidos
            $filename = $_FILES['foto2']['tmp_name']; // obtener nombre temporal del archivo
            $file_type = mime_content_type($filename); // obtener tipo MIME del archivo

            if (in_array($file_type, $allowed_mime_types)) {
                // El archivo es una imagen jpeg o png
                $nombreDirectorio = '../Imagenes/';
                $foto = $nombreDirectorio . $_FILES['foto2']['name'];
                move_uploaded_file($_FILES['foto2']['tmp_name'], $foto);
            } 
        }
        if (is_uploaded_file($_FILES['foto3']['tmp_name'])) {
            $allowed_mime_types = array('image/jpeg', 'image/png', 'image/jpg', 'image/gif'); // tipos MIME permitidos
            $filename = $_FILES['foto3']['tmp_name']; // obtener nombre temporal del archivo
            $file_type = mime_content_type($filename); // obtener tipo MIME del archivo

            if (in_array($file_type, $allowed_mime_types)) {
                // El archivo es una imagen jpeg o png
                $nombreDirectorio = '../Imagenes/';
                $foto = $nombreDirectorio . $_FILES['foto3']['name'];
                move_uploaded_file($_FILES['foto3']['tmp_name'], $foto);
            } 
        }
        if (is_uploaded_file($_FILES['foto4']['tmp_name'])) {
            $allowed_mime_types = array('image/jpeg', 'image/png', 'image/jpg', 'image/gif'); // tipos MIME permitidos
            $filename = $_FILES['foto4']['tmp_name']; // obtener nombre temporal del archivo
            $file_type = mime_content_type($filename); // obtener tipo MIME del archivo

            if (in_array($file_type, $allowed_mime_types)) {
                // El archivo es una imagen jpeg o png
                $nombreDirectorio = '../Imagenes/';
                $foto = $nombreDirectorio . $_FILES['foto4']['name'];
                move_uploaded_file($_FILES['foto4']['tmp_name'], $foto);
            } 
        }

            $nombre = $_REQUEST['nombre'];
            $precio = $_REQUEST['precio'];
            $descripcion = $_REQUEST['descripcion'];
            
            //insertamos el producto en la tabla
                    $sql = "INSERT INTO Productos(Fecha, Nombre, Precio, Descripcion, Foto, Foto1, Foto2, Foto3, Foto4) VALUES  
                    ('$fechaHoraActual', '$nombre', '$precio', '$descripcion', '$foto', '$foto1', '$foto2', '$foto3', '$foto4');";

                    $dwes->query($sql);
            
                    unset($dwes);
            
                      echo "<div class='px-4 py-5 my-5 text-center'>
                      <img class='d-block mx-auto mb-4' src='../Imagenes/logo.png' alt='' width='72' height='57'>
                      <h1 class='display-5 fw-bold'>¡Genial!</h1>
                      <div class='col-lg-6 mx-auto'>
                        <p class='lead mb-4'>Se ha añadido correctamente</p>
                        <div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>
                          <a href='admintienda.php'><button type='button' class='btn btn-primary btn-lg px-4 gap-3'>Ver tienda</button></a>
                        </div>
                      </div>
                    </div>";
                    }
                      else {
          ?>

 
  <div class="container-md mt-2">
        <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" ENCTYPE="multipart/form-data" onsubmit='return formularioArticulo();'>
        <div class="col-md-8">
          <label class="form-label">Nombre</label>
          <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Precio</label>
          <input type="text" class="form-control" name="precio" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Descripcion</label>
          <input type="text" class="form-control" name="descripcion" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Imagen</label>
          <input class="form-control" type="file" name="foto" requerid>
        </div>
        <div class="col-md-3">
          <label class="form-label">Imagen 1</label>
          <input class="form-control" type="file" name="foto1">
        </div>
        <div class="col-md-3">
          <label class="form-label">Imagen 2</label>
          <input class="form-control" type="file" name="foto2">
        </div>
        <div class="col-md-3">
          <label class="form-label">Imagen 3</label>
          <input class="form-control" type="file" name="foto3">
        </div>
        <div class="col-md-3">
          <label class="form-label">Imagen 4</label>
          <input class="form-control" type="file" name="foto4">
        </div>

<div class="text-center" style="color:red;" id="info"></div>

<div class="col-12 d-flex justify-content-center py-5">
  <button class="btn btn-primary" name="añadir" type="submit">Añadir producto</button>
</div>

      </form>

      <?php
    }
    ?>

<script>
function formularioArticulo() {
  var nombre = document.getElementsByName("nombre")[0].value;
  var precio = document.getElementsByName("precio")[0].value;
  var descripcion = document.getElementsByName("descripcion")[0].value;
  var foto = document.getElementsByName("foto")[0].value;

  var allowedExtensions = /(\.jpg|\.png)$/i;

  if (nombre.trim() === "" || descripcion.trim() === "" || foto.trim() === "") {
    document.getElementById("info").innerHTML = "Por favor, completa todos los campos obligatorios.";
    return false;
  } else if (!allowedExtensions.exec(foto)) {
    document.getElementById("info").innerHTML = "La foto debe ser un archivo JPG o PNG.";
    return false;
  } else if (parseFloat(precio) < 0.99 || parseFloat(precio) > 99 || isNaN(parseFloat(precio))) {
    document.getElementById("info").innerHTML = "El precio debe ser un número entre 0.99 y 99.";
    return false;
  }

  return true;
}
</script>


      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>

<?php echo $footer; ?>
    </body>
</html>