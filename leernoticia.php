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
        <li class="nav-item"><a href="noticias.php" class="nav-link px-2 link-dark active">Noticias</a></li>
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



  
  <?php
  
        if (!isset($error)) {
  

          $id = $_GET['IdNoticia'];
          $sql = "SELECT * FROM Noticias WHERE IdNoticia=$id ";
          $resultado = $dwes->query($sql);
          if ($resultado) {
              $row = $resultado->fetch();
              while ($row != null) {
                  $nombre = $row['Titulo'];
                  $Fuente = $row['Fuente'];
                  $Texto = $row['Texto'];
                  $Fecha = $row['Fecha'];

                  // Contador para llevar la cuenta de los puntos encontrados
                  $contadorPuntos = 0;

                  // Reemplazar cada tercer punto seguido de un espacio con "<br>"
                  $Texto = preg_replace_callback('/\.\s/', function($matches) use (&$contadorPuntos) {
                      $contadorPuntos++;

                      if ($contadorPuntos % 3 === 0) {
                          return ".<br><br>";
                      } else {
                          return $matches[0];
                      }
                  }, $Texto);                  


                  $categoria = $row['Categoria'];
                  $foto = $row['Foto'];
  
                  echo "<div class='container px-4 py-5' id='custom-cards'>
                  <h2 class='pb-2 border-bottom'>$nombre</h2>
              
                  <div class='align-items-stretch g-4 py-3'>
                    <div class='col'>
                      <div class='card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg' style='background-image: url(\"$foto\");'>
                        <div class='d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1'>
                          <ul class='d-flex list-unstyled mt-auto'>
                            <li class='me-auto'>Fecha: $Fecha
                            </li>
                            <li class='d-flex align-items-center me-2'>Fuente: $Fuente
                            </li>                  
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class='container px-4 pb-4' id='custom-cards'>
                <p class='pt-2' style='text-align: justify !important;'>$Texto</p>
                </div>
                <div class='d-grid gap-2 d-md-flex justify-content-center mb-4 mb-lg-3'>
                </div><br>" ;
                      
                  $row = $resultado->fetch();
              }}  
        };
    

    ?>

<div class="container px-4" id="custom-cards">
  <div class="d-flex justify-content-between">
    <a href="noticias.php"><button type="button" class="btn btn-outline-primary"><i class="bi bi-arrow-90deg-left"></i> Volver atrás</button></a>
<?php
              $sql = "SELECT * FROM Noticias WHERE IdNoticia=$id+1";
              $resultado = $dwes->query($sql);
              if ($resultado) {
                $row = $resultado->fetch();
                if($row != null) {
                echo "<a href='leernoticia.php?IdNoticia=".($id+1)."'><button type='button' class='btn btn-primary'>Siguiente noticia <i class='bi bi-arrow-right'></i></button></a>";
                }
             }  
?>
</div>
</div>


      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
      <?php echo $footer; ?>
</body>
</html>