<?php
session_start();
if(isset($_SESSION['Admin']))
{
  if($_SESSION['Admin']==1)
  {
    header("Location: admin.php");
  }
}
if (!isset($_SESSION['correo'])) {
  header("Location: index.php");
}
include "global.php";

if (isset($_POST['cerrar'])) {
  $sql1 = 'DELETE FROM Activos WHERE IdActivo=' . $_REQUEST["idactivo"];
  $resultado1 = $dwes->query($sql1);

  $_SESSION['Saldo'] = $_SESSION['Saldo'] + $_REQUEST["valorcerrar"];
  $sql = "UPDATE Clientes SET Saldo = '".$_SESSION['Saldo']."' WHERE IdCliente =" .$_SESSION['IdCliente'];
  $dwes->query($sql);
}

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
        <a href="editarperfil.php"><button class="btn btn-primary">Editar perfil</button></a>
      </div>
    </div>
  </div>

  <div class="container px-3" id="custom-cards">
  <div class="row align-items-center">
    <div class="col-12">
      <h3 class="text-center">Saldo actual:
        <span class="border border-primary rounded p-2">
          <?php echo $_SESSION['Saldo']; ?> €
        </span>
        <button class="btn btn-primary ms-2 mb-2" onclick="anadirDinero()"><i class="bi bi-plus-lg"></i></button>
      </h3>
    </div>
  </div>
</div>


<?php 


if (!isset($error)) {
  $sql = "SELECT * FROM Activos WHERE IdCliente=" . $_SESSION['IdCliente'];
  $resultado = $dwes->query($sql);
  if ($resultado != null) {
    $row = $resultado->fetch();
    while ($row != null) {
      $datosactivos=true;
      $row = $resultado->fetch();
    }
  }}

  if (!isset($error)) {
    $sql = "SELECT * FROM  Compras WHERE IdCliente=" . $_SESSION['IdCliente'];
    $resultado = $dwes->query($sql);
    if ($resultado != null) {
      $row = $resultado->fetch();
      while ($row != null) {
        $datoscompras=true;
        $row = $resultado->fetch();
      }
    }}

if(isset($datosactivos)){
  if (!isset($error)) {
    $sql = "SELECT * FROM Activos WHERE IdCliente=" . $_SESSION['IdCliente'];
    $resultado = $dwes->query($sql);
    if ($resultado != null) {
      $row = $resultado->fetch();
      echo '<div class="container px-4 py-5" id="custom-cards">
            <h2 class="pb-2 border-bottom">Activos</h2>
            <div class="align-items-stretch g-4 py-3" id="valoresDivisas">';

      while ($row != null) {
        $idactivo = $row['IdActivo'];
        $nombre = $row['Nombre'];
        $cantidad = $row['Cantidad'];
        $precio = $row['Precio'];
        $fecha = $row['Fecha'];

        // Generar número aleatorio del 0 al 10
        $variacion = rand(-10, 10);

        // Calcular resultado (suma de variación y cantidad)
        $total = $variacion +  intval($cantidad);
        
        // Determinar el color del resultado
        $color = '';
        if ($total < 0) {
          $color = 'red'; // Rojo
        } elseif ($total > 0) {
          $color = 'green'; // Verde
        }

        echo "<div class='col pt-2'> <div class='card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg p-5 pb-3 zooom'>
              <ul class='d-flex list-unstyled mt-auto'>
                <li class='me-auto'>
                  <strong class='text-danger-emphasis'><i class='bi bi-currency-exchange'></i> $nombre</strong>
                  <strong>Precio de compra: </strong>$precio Variación: $variacion  <span style='color: $color;'><strong>Resultado: $total €</span></strong>
                </li>
                <li class='d-flex align-items-center me-2'>
                  Fecha: $fecha
                </li>
                <li class='d-flex align-items-center me-2'>
                <strong>Cantidad: </strong> &nbsp; $cantidad 
              </li>
                <li class='d-flex align-items-center me-2'>
                <form name='input' action='perfil.php' method='post' enctype='multipart/form-data'>
                <input type='hidden' name='valorcerrar' value='$total'>
                <input type='hidden' name='idactivo' value='$idactivo'>
                <button type='submit' name='cerrar' class='btn btn-danger'>Cerrar</button>
                </form>
                </li>
              </ul>
      </div></div>";

        $row = $resultado->fetch();
      }
      echo "</div></div>";
    }}
    }


    if(isset($datoscompras)){
      if (!isset($error)) {
        $sql = "SELECT * FROM Compras WHERE IdCliente=" . $_SESSION['IdCliente'];
        $resultado = $dwes->query($sql);
        if ($resultado != null) {
          $row = $resultado->fetch();
          echo "<div class='container px-4 py-2' id='custom-cards'>
          <h2 class='pb-2 border-bottom'>Compras</h2>
          <div class='row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-3'>";
    
          while ($row != null) {
            $cantidad = $row['Cantidad'];
            $IdProducto = $row['IdProducto'];
            $fecha = $row['Fecha'];
    
            $sql2 = "SELECT * FROM Productos WHERE IdProducto=" . $IdProducto;
            $resultado2 = $dwes->query($sql2);
            if ($resultado2 != null) {
              $row2 = $resultado2->fetch();
              while ($row2 != null) {
                $id = $row2['IdProducto'];
                $nombre = $row2['Nombre'];
                $precio = $row2['Precio'];
                $descripcion = $row2['Descripcion'];
                $foto = $row2['Foto'];
                
                $row2 = $resultado2->fetch();
              }
            }
            
            echo "<div class='col zoom'>
            <div class='card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg' style='background-image: url(\"$foto\");'>
              <div class='d-flex flex-column h-100 p-5 pb-3 text-black text-shadow-1'>
                <h3 class='pt-5 mt-5 mb-4 lh-1 fw-bold'>$nombre</h3>
                <ul class='d-flex list-unstyled mt-auto'>
                  <li class='me-auto'>
                    $precio € x $cantidad
                  </li>
                  <li class='d-flex align-items-center me-2'>
                    <button type='button' class='btn btn-danger'>Comprado</button>
                  </li>
                </ul>
              </div>
            </div>
          </div>";
    
            $row = $resultado->fetch();
          }
          echo "</div></div>";
        }}
        }
    


    if(!isset($datosactivos) && !isset($datoscompras)){

      echo "<div class='px-4 py-5 my-5 text-center '>
          <h1 class='display-5 fw-bold'>No hay activos ni productos</h1>
          <div class='col-lg-6 mx-auto'>
            <p class='lead mb-4'>Aún no has realizado ninguna compra</p>
            <div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>
            <a href='mercado.php'><button type='button' class='btn btn-primary btn-lg px-4 me-md-2 fw-bold'>Ver mercado</button></a>
            <a href='tienda.php'><button type='button' class='btn btn-primary btn-lg px-4 me-md-2 fw-bold'>Ver tienda</button></a>
            </div>
          </div>
        </div>";

    }
?>

      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
      <?php echo $footer; ?>
    </body>
</html>