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
    <title>ReTradeX - Tienda</title>
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
        <li class="nav-item"><a href="tienda.php" class="nav-link px-2 link-dark active">Tienda</a></li>
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
        <h1 class="d-inline">Merchandising</h1>
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
 

  <div class="container px-4 py-5" id="custom-cards">
        <h3 class="pb-2 border-bottom">Preguntas frecuentes</h3>
    
        <div class=" align-items-stretch g-4 py-3">
          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  ¿Cuánto tiempo tarda el pedido?
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">El tiempo de preparación de un diseño puede variar dependiendo de varios factores, el tiempo medio está en torno a los 1-5 días hábiles.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  ¿Cómo se hace el pago?
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Le enviaremos su diseño con marcas de agua, una vez realizado el pago con PayPal o Tarjeta de Crédito le enviaremos el diseño completo y listo para usar.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  ¿Hay devoluciones?
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">¡Por supuesto!</div>
              </div>
            </div>
          </div>
        </div>
      </div>


      
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
    let url = "cargarproductos.php"
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