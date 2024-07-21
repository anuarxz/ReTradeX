<?php
session_start();
include "global.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReTradeX - Política de privacidad</title>
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
        <h1 class="d-inline">Política de Privacidad de ReTradeX</h1>
      </div>
    </div>
  </div>


  <div class="container px-4 py-3" id="custom-cards">


<p>En ReTradeX, nos tomamos muy en serio la privacidad de nuestros usuarios. Esta Política de Privacidad describe cómo recopilamos, utilizamos y protegemos la información personal que nos proporcionas al utilizar nuestro sitio web.</p>

<h2>Recopilación de Información</h2>
<p>Recopilamos información personal que nos proporcionas voluntariamente al registrarte en nuestro sitio web, realizar compras, participar en el foro u otras actividades interactivas. Esta información puede incluir tu nombre, dirección de correo electrónico, datos de contacto y detalles de pago.</p>

<h2>Uso de la Información</h2>
<p>Utilizamos la información personal recopilada para proporcionarte nuestros servicios, procesar tus compras, responder a tus consultas y brindarte soporte al cliente. Además, podemos utilizar tu información para mejorar nuestros servicios, personalizar tu experiencia en el sitio web y enviar comunicaciones promocionales, siempre y cuando hayas dado tu consentimiento.</p>

<h2>Compartir Información</h2>
<p>No vendemos, alquilamos ni compartimos tu información personal con terceros no afiliados, excepto cuando sea necesario para cumplir con la ley, proteger nuestros derechos o en cumplimiento de una solicitud legal.</p>

<h2>Seguridad de la Información</h2>
<p>Implementamos medidas de seguridad para proteger tu información personal contra accesos no autorizados, divulgación o alteración. Sin embargo, ten en cuenta que ningún método de transmisión por Internet o método de almacenamiento electrónico es 100% seguro, y no podemos garantizar la seguridad absoluta de tu información.</p>

<h2>Cookies y Tecnologías Similares</h2>
<p>Utilizamos cookies y otras tecnologías similares para mejorar tu experiencia en nuestro sitio web, personalizar el contenido y los anuncios, y analizar el tráfico del sitio. Puedes controlar el uso de cookies a través de la configuración de tu navegador, pero ten en cuenta que desactivar las cookies puede afectar la funcionalidad de ciertas partes de nuestro sitio web.</p>

<h2>Enlaces a Terceros</h2>
<p>Nuestro sitio web puede contener enlaces a sitios web de terceros. Esta Política de Privacidad se aplica solo a nuestro sitio web, por lo que te recomendamos que revises las políticas de privacidad de los sitios web de terceros antes de proporcionarles tu información personal.</p>

<h2>Actualización de la Política de Privacidad</h2>
<p>Nos reservamos el derecho de actualizar o modificar esta Política de Privacidad en cualquier momento. Te notificaremos cualquier cambio material mediante una notificación en nuestro sitio web o por otros medios antes de que los cambios entren en vigencia. Te recomendamos que revises esta Política de Privacidad periódicamente para estar informado/a sobre cómo protegemos tu información.</p>

<h2>Contacto</h2>
<p>Si tienes alguna pregunta o inquietud acerca de nuestra Política de Privacidad, por favor contáctanos a través de los canales de atención al cliente proporcionados en nuestro sitio web.</p>

  </div>

    <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
<?php echo $footer; ?>
    </body>
</html>