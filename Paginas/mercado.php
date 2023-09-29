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
    <title>ReTradeX - Mercado</title>
    <link rel="icon" type="image/jpg" href="../Imagenes/logo.png"/>
    <link rel="stylesheet" href="../Estilos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-2">
      <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="img-fluid" src="../Imagenes/logo.png" height="75px" width="75px">
      </a>

      <ul class="nav nav-pills col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a href="index.php" class="nav-link px-2 link-dark">Inicio</a></li>
        <li class="nav-item"><a href="mercado.php" class="nav-link px-2 link-dark active">Mercado</a></li>
        <li class="nav-item"><a href="noticias.php" class="nav-link px-2 link-dark">Noticias</a></li>
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
  
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://es.tradingview.com/" rel="noopener nofollow" target="_blank"></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
  {
  "symbols": [
    {
      "proName": "FOREXCOM:SPXUSD",
      "title": "S&P 500"
    },
    {
      "proName": "FOREXCOM:NSXUSD",
      "title": "US 100"
    },
    {
      "proName": "FX_IDC:EURUSD",
      "title": "EUR/USD"
    },
    {
      "proName": "BITSTAMP:BTCUSD",
      "title": "Bitcoin"
    },
    {
      "proName": "BITSTAMP:ETHUSD",
      "title": "Ethereum"
    }
  ],
  "showSymbolLogo": true,
  "colorTheme": "light",
  "isTransparent": false,
  "displayMode": "adaptive",
  "locale": "es"
}
  </script>
</div>



  <div class="container px-4 mb-0" id="custom-cards">
  <div class="row align-items-center">
      <div class="col">
        <h1 class="d-inline">Mercado de valores</h1>
      </div>
      <div class="col-auto">
        <div class="input-group">
        <input type="text" id="campo" class="form-control" placeholder="Buscar">
        <div class="btn btn-primary" style="pointer-events: none;"><i class="bi bi-search"></i></div>
        </div>
      </div>
    </div>
  </div>

<?php
  if (isset($_POST['comprar'])) {
    foreach ($_POST as $key => $value) {
      if (strpos($key, 'cantidad_') === 0) {
        $divisa = substr($key, strlen('cantidad_'));
        if($value>0){
        $cantidad = $value;
        $precio = $_POST['precio_' . $divisa];
        $entrada = $_POST['activo_' . $divisa];
        
        date_default_timezone_set('Europe/Madrid');
        $fechaHoraActual = date('Y-m-d H:i:s');

        $sql = "INSERT INTO Activos(Fecha, Precio, Cantidad, Nombre, IdCliente) VALUES  
        ('$fechaHoraActual', '$precio', '$cantidad €', '$entrada', '".$_SESSION['IdCliente']."');";

        $dwes->query($sql);

        $_SESSION['Saldo'] = $_SESSION['Saldo'] - $cantidad;

        $sql = "UPDATE Clientes SET Saldo = '".$_SESSION['Saldo']."' WHERE IdCliente =" .$_SESSION['IdCliente'];

        $dwes->query($sql);

        unset($dwes);

        echo "<div class='px-4 py-5 my-5 text-center'>
            <img class='d-block mx-auto mb-4' src='../Imagenes/logo.png' alt='' width='90' height='75'>
            <h2 class='fw-bold'>¡Genial!</h2>
            <h4 class='py-3'>Has comprado $entrada por $cantidad € a un precio de $precio</h4>
            <div class='col-lg-6 mx-auto'>
              <div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>
                <a href='mercado.php'><button type='button' class='btn btn-primary btn-lg px-4 gap-3'>Ver mercado</button></a>
                <a href='perfil.php'><button type='button' class='btn btn-outline-primary btn-lg px-4 gap-3'>Ver perfil</button></a>
              </div>
            </div>
          </div>";

          

        }
      }
    }
  }else{

?>

<div id="mensajeDiv" class="toast align-items-center text-bg-primary fade show" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left: auto; margin-right: auto; display: none;">
  <div class="d-flex">
    <div class="toast-body">
    <i class="bi bi-exclamation-circle"></i>   &nbsp;&nbsp;¡Inicia sesión o regístrate para poder comprar!
    </div>
  </div>
</div>

<div id="errorcantidad" class="toast align-items-center text-bg-primary fade show" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left: auto; margin-right: auto; display: none;">
  <div class="d-flex">
    <div class="toast-body">
      <i class="bi bi-exclamation-circle"></i> &nbsp;&nbsp;¡Valor incorrecto o no tiene suficiente saldo!
    </div>
  </div>
</div>

<?php
        if (!isset($_SESSION['correo'])) {
          $boton = '<button type="button" name="comprar" class="btn btn-danger" onclick="mostrarDiv()">Comprar</button>';
        }else{
            $boton = '<button type="submit" name="comprar" onclick="validarCantidad(event, \'' . '${par}' . '\')" class="btn btn-danger">Comprar</button>';
        }
?> 


<form name="input" action="mercado.php" method="post" enctype="multipart/form-data">

  <div class="container px-4 py-5" id="custom-cards">
    <h2 class="pb-2 border-bottom">Divisas</h2>
    <div class="align-items-stretch g-4 py-3" id="valoresDivisas">
      <!-- Aquí se agregarán las divisas -->
      
    </div>
  </div>


  <script>
    var valoresAnteriores = {};

    function obtenerValoresDivisas() {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var valores = JSON.parse(xhr.responseText);
          actualizarValoresDivisas(valores);
        }
      };
      xhr.open("GET", "obtener_valores_divisas.php", true);
      xhr.send();
    }

    function actualizarValoresDivisas(valores) {
      var divContenedor = document.getElementById("valoresDivisas");

      // Limpiar el contenedor
      divContenedor.innerHTML = "";

      // Recorrer los valores y agregarlos como elementos en el contenedor
      var divisas = Object.keys(valores);
      var divisasMostradas = 0;

      for (var i = 0; i < divisas.length; i++) {
        var par = divisas[i];
        var valor = valores[par].valor;
        var valorAnterior = valoresAnteriores[par] ? valoresAnteriores[par].valor : undefined;
        var maximoDiario = valores[par].maximoDiario;
        var minimoDiario = valores[par].minimoDiario;

        var divisaItem = document.createElement("div");
        divisaItem.className = "col pt-2";

        var colorTexto = "";
        if (valorAnterior !== undefined) {
          if (valor > valorAnterior) {
            colorTexto = "green";
          } else if (valor < valorAnterior) {
            colorTexto = "red";
          }
        }

        divisaItem.innerHTML = `<div class='card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg p-5 pb-3 zooom'>
                                <ul class='d-flex list-unstyled mt-auto'>
                                  <li class='me-auto'>
                                    <strong class="text-danger-emphasis"><i class="bi bi-currency-exchange"></i> ${par}</strong>
                                    <strong>Máximo diario:</strong> ${maximoDiario}
                                    <strong>Mínimo diario:</strong> ${minimoDiario}
                                    <strong>Precio actual:</strong> <span style='color: ${colorTexto};'>${valor}</span>
                                  </li>
                                  <li class='d-flex align-items-center me-2'>
                                    <input type="number" class="form-control" name="cantidad_${par}" id="cantidad_${par}">
                                    <input type="hidden" class="form-control" name="precio_${par}" value="${valor}">
                                    <input type="hidden" class="form-control" name="activo_${par}" value="${par}">
                                  </li>
                                  <li class='d-flex align-items-center me-2'>
                                  <?php echo $boton; ?>
                                  </li>
                                </ul>
                              </div>`;

        divContenedor.appendChild(divisaItem);

        // Actualizar el valor anterior
        valoresAnteriores[par] = { valor, maximoDiario, minimoDiario };
      }
    }

    // Actualizar los valores de las divisas cada segundo
    setInterval(obtenerValoresDivisas, 5000);

  </script>


<script>
  var saldo = <?php echo $_SESSION['Saldo']; ?>;

  function validarCantidad(event, par) {
  var cantidadInput = document.getElementsByName("cantidad_" + par)[0];
  var cantidad = cantidadInput.value.trim(); // Obtener el valor y eliminar espacios en blanco

  if (cantidad === "") {
    mostrarErrorCantidad();
    event.preventDefault(); // Detener el envío del formulario
  } else {
    cantidad = parseInt(cantidad);

    if (cantidad < 1 || cantidad > saldo) {
      mostrarErrorCantidad();
      event.preventDefault(); // Detener el envío del formulario
    } else {
      document.input.submit(); // Enviar el formulario si la cantidad es válida
    }
  }
}

function mostrarErrorCantidad() {
  var errorCantidad = document.getElementById("errorcantidad");
  errorCantidad.style.display = "block";

  setTimeout(function() {
    errorCantidad.style.display = "none";
  }, 5000); // Ocultar el mensaje después de 5 segundos (5000 milisegundos)
}


</script>




<div class="container px-4 py-5" id="custom-cards">
  <h2 class="pb-2 border-bottom">Acciones</h2>
  <div class="align-items-stretch g-4 py-3" id="valoresAcciones">
    <h4 class='text-center' style='color:red;'>Disponible próximamente</h4>
  </div>
</div>

  



<div class="container px-4 py-5" id="custom-cards">
  <h2 class="pb-2 border-bottom">Índices</h2>
  <div class="align-items-stretch g-4 py-3" id="valoresIndices">
    <h4 class='text-center' style='color:red;'>Disponible próximamente</h4>
  </div>
</div>

  
<script>
obtenerValoresDivisas();


(() => {
  'use strict'
  document.querySelectorAll('[data-bs-toggle="tooltip"]')
    .forEach(tooltip => {
      new bootstrap.Tooltip(tooltip)
    })


})()


function mostrarDiv(button) {
    var mensajeDiv = document.getElementById("mensajeDiv");

    // Verificar si el div ya está visible
    if (mensajeDiv.style.display === "block") {
      // Ocultar el div si ya está visible
      mensajeDiv.style.display = "none";
    } else {
      // Ocultar cualquier otro div visible
      var divs = document.getElementsByClassName("toast");
      for (var i = 0; i < divs.length; i++) {
        var div = divs[i];
        if (div.id !== "mensajeDiv" && div.style.display === "block") {
          div.style.display = "none";
        }
      }

      // Mostrar el div
      mensajeDiv.style.display = "block";
    }

  }
</script>


</form>
<?php
  }

  ?>
      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>

      <?php echo $footer; ?>
</body>
</html>