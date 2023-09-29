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
        <li class="nav-item"><a href="adminnoticias.php" class="nav-link px-2 link-dark active">Noticias</a></li>
        <li class="nav-item"><a href="adminforo.php" class="nav-link px-2 link-dark">Foro</a></li>
        <li class="nav-item"><a href="admintienda.php" class="nav-link px-2 link-dark">Tienda</a></li>
      </ul>
      <div class="col-md-3 text-end">
        <a href="cerrarsesion.php"><button type="button" class="btn btn-outline-primary me-2 m-1">Cerrar Sesión</button></a>
      </div>
    </header>
  </div>

  
  <div class="container px-3 py-5" id="custom-cards">
  <div class="row align-items-center">
      <div class="col">
        <h1 class="d-inline">Añadir noticia</h1>
      </div>
    </div>
  </div>

  <?php
          if (isset($_POST['añadir'])) {

            date_default_timezone_set('Europe/Madrid');
            $fechaHoraActual = date('Y-m-d H:i:s');

            $foto = "";

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


            $titulo = $_REQUEST['titulo'];
            $categoria = $_REQUEST['categoria'];
            $fuente = $_REQUEST['fuente'];
            $texto = $_REQUEST['texto'];
            
            
                    $sql = "INSERT INTO Noticias(Fecha, Titulo, Categoria, Fuente, Foto, Texto) VALUES  
                    ('$fechaHoraActual', '$titulo', '$categoria', '$fuente', '$foto', '$texto');";

                    $dwes->query($sql);
            
                    unset($dwes);
            
                      echo "<div class='px-4 py-5 my-5 text-center'>
                      <img class='d-block mx-auto mb-4' src='../Imagenes/logo.png' alt='' width='72' height='57'>
                      <h1 class='display-5 fw-bold'>¡Genial!</h1>
                      <div class='col-lg-6 mx-auto'>
                        <p class='lead mb-4'>Se ha añadido correctamente</p>
                        <div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>
                          <a href='adminnoticias.php'><button type='button' class='btn btn-primary btn-lg px-4 gap-3'>Ver noticias</button></a>
                        </div>
                      </div>
                    </div>";
                    }
                      else {
          ?>

 
  <div class="container-md mt-2">
        <form class="row g-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" ENCTYPE="multipart/form-data" onsubmit='return formularioNoticia();'>
        <div class="col-md-8">
          <label class="form-label">Título</label>
          <input type="text" class="form-control" name="titulo" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Categoría</label>
          <input type="text" class="form-control" name="categoria" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Fuente</label>
          <input type="text" class="form-control" name="fuente" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Imagen</label>
          <input class="form-control" type="file" name="foto" requerid>
        </div>
        <div class="col-md-12">
          <label class="form-label">Texto</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" name="texto" rows="10"></textarea>
        </div>
<div class="text-center" style="color:red;" id="info"></div>

<div class="col-12 d-flex justify-content-center py-5">
  <button class="btn btn-primary" name="añadir" type="submit">Añadir noticia</button>
</div>

      </form>

      <?php
    }
    ?>

      <script>

function formularioNoticia() {
  var titulo = document.getElementsByName("titulo")[0].value;
  var categoria = document.getElementsByName("categoria")[0].value;
  var fuente = document.getElementsByName("fuente")[0].value;
  var texto = document.getElementsByName("texto")[0].value;
  var foto = document.getElementsByName("foto")[0].value;

  var allowedExtensions = /(\.jpg|\.png)$/i;

  if (titulo.trim() === "" || categoria.trim() === "" || fuente.trim() === "" || texto.trim() === "" || foto.trim() === "") {
    document.getElementById("info").innerHTML = "Por favor, completa todos los campos.";
    return false;
  } else if (!allowedExtensions.exec(foto)) {
    document.getElementById("info").innerHTML = "La imagen debe ser un archivo JPG o PNG.";
    return false;
  }

  return true;
}


</script>

      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>

<?php echo $footer; ?>
    </body>
</html>