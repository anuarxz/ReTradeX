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
        <h1 class="d-inline">Productos</h1>
      </div>
      <div class="col-auto">
        <div class="input-group">
        <div class="col-12 d-flex justify-content-center"><a href="añadirarticulo.php"><button class="btn btn-primary" type="button">Añadir artículo</button></a></div>
        </div>
      </div>
    </div>
  </div>


 
<?php
    if (isset($_POST['eliminar'])) {
        $sql1 = 'DELETE FROM Productos WHERE IdProducto=' . $_REQUEST["idborrar"];
        $resultado1 = $dwes->query($sql1);
    }


    if (!isset($error)) {
        $sql = "SELECT * FROM Productos ORDER BY IdProducto DESC";
        $resultado = $dwes->query($sql);
      
        echo "<div class='container px-4 py-4' id='custom-cards'>
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
                        <form name='input' action='admintienda.php' method='post' ENCTYPE='multipart/form-data'>
                        <input type='hidden' name='idborrar' value='$id'>
                        <button  type='submit' name='eliminar' class='btn btn-danger'>Eliminar</button>
                        </form>
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



      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>

<?php echo $footer; ?>
    </body>
</html>