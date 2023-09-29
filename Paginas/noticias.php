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
 

 

  <div class="container px-4 py-5" id="custom-cards">
  <div class="row align-items-center">
      <div class="col">
        <h1 class="d-inline">Noticias</h1>
      </div>
      <div class="col-auto">
        <div class="input-group">
        <input type="text" id="campo" class="form-control" placeholder="Buscar">
        <div class="btn btn-primary" style="pointer-events: none;"><i class="bi bi-search"></i></div>
        </div>
      </div>
    </div>
  </div>



  <div id="content"></div>
 

      
      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
      <script>
//Iniciamos la funcion 
getData();

//Cuando pulsamos en el campo o tecleeamos se ejecuta la funcion
document.getElementById("campo").addEventListener("keyup",getData);

//Creamos la funcion para el buscador
function getData(){
  //Recogemos el valor del campo
    let input = document.getElementById("campo").value
    //Recogemos el valor donde ira el contenido
    let content = document.getElementById("content")
    //Recogemos el archivo
    let url = "cargarnoticias.php"
    let formaData = new FormData()
    formaData.append("campo", input) 

    //Realizamos las peticiones con JSON mediante el metodo POST
    fetch(url, {
        method: "POST",
        body: formaData
    }).then(response => response.json())
    .then(data => {
        content.innerHTML = data
    }).catch(err => console.log(err));
}


  //Realizado por Anuar Iziani
  </script>

<?php echo $footer; ?>
    </body>
</html>