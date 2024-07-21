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
    <title>ReTradeX - Términos</title>
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
        <h1 class="d-inline">Términos y Condiciones de Uso de ReTradeX</h1>
      </div>
    </div>
  </div>


  <div class="container px-4 py-3" id="custom-cards">

  <h2>1. Aceptación de los Términos y Condiciones</h2>
  <p>Al acceder o utilizar nuestro sitio web, aceptas cumplir con estos Términos y Condiciones en su totalidad. Estos términos constituyen un acuerdo legalmente vinculante entre tú y ReTradeX S.L. Si no estás de acuerdo con alguno de estos términos, no debes utilizar nuestro sitio web.</p>

  <h2>2. Uso del Sitio Web</h2>
  <h3>2.1 Licencia de Uso</h3>
  <p>ReTradeX te otorga una licencia limitada, no exclusiva y no transferible para acceder y utilizar nuestro sitio web con fines personales y no comerciales. No tienes permiso para modificar, distribuir, transmitir, exhibir, realizar, reproducir, publicar, licenciar, crear trabajos derivados de, transferir o vender cualquier información, software, productos o servicios obtenidos de o a través de nuestro sitio web.</p>
  <h3>2.2 Registro</h3>
  <p>Para acceder a ciertas funciones y servicios de nuestro sitio web, es posible que debas registrarte y crear una cuenta. Al hacerlo, te comprometes a proporcionar información precisa, actualizada y completa. Eres responsable de mantener la confidencialidad de tu cuenta y contraseña, y aceptas aceptar la responsabilidad de todas las actividades que ocurran bajo tu cuenta.</p>

  <h2>3. Compra de Activos y Artículos</h2>
  <h3>3.1 Activos de la Bolsa</h3>
  <p>ReTradeX ofrece una plataforma en la que puedes comprar activos de la bolsa. Sin embargo, debes tener en cuenta que invertir en la bolsa conlleva riesgos y fluctuaciones de mercado. No garantizamos ni ofrecemos asesoramiento financiero, por lo que debes tomar tus propias decisiones de inversión informadas.</p>
  <h3>3.2 Tienda de Artículos</h3>
  <p>Nuestra plataforma también cuenta con una tienda en línea donde puedes adquirir diversos productos. Al realizar una compra, aceptas cumplir con los términos de compra y pago establecidos, incluidas las políticas de envío, devolución y reembolso.</p>

  <h2>4. Foro y Comentarios</h2>
  <p>ReTradeX proporciona un foro y una sección de comentarios para fomentar la interacción entre los usuarios. Sin embargo, nos reservamos el derecho de supervisar y moderar dichas áreas. Al participar en ellas, aceptas no publicar contenido difamatorio, ofensivo, ilegal o que viole los derechos de terceros. Nos reservamos el derecho de eliminar cualquier contenido que consideremos inapropiado.</p>

  <h2>5. Propiedad Intelectual</h2>
  <p>Todos los derechos de propiedad intelectual asociados con ReTradeX, incluidos los derechos de autor, marcas comerciales y patentes, son propiedad exclusiva de ReTradeX S.L. Queda estrictamente prohibida cualquier reproducción, distribución o utilización no autorizada de estos materiales, salvo que se permita expresamente por escrito por parte de ReTradeX S.L.</p>

  <h2>6. Limitación de Responsabilidad</h2>
  <p>En la medida permitida por la ley, ReTradeX S.L. no será responsable de ningún daño directo, indirecto, incidental, consecuente o especial que resulte del uso o la imposibilidad de utilizar nuestro sitio web. No garantizamos la exactitud, integridad o actualidad de la información proporcionada en nuestro sitio web.</p>

  <h2>7. Modificaciones de los Términos y Condiciones</h2>
  <p>Nos reservamos el derecho de modificar estos Términos y Condiciones en cualquier momento y sin previo aviso. Las modificaciones entrarán en vigencia tan pronto como se publiquen en nuestro sitio web. Es tu responsabilidad revisar periódicamente esta página para estar informado/a sobre cualquier cambio. Si continúas utilizando nuestro sitio web después de la publicación de cambios en los términos, se considerará que has aceptado dichos cambios.</p>

  <p>Si tienes alguna pregunta o inquietud acerca de estos Términos y Condiciones, por favor contáctanos a través de los canales de atención al cliente proporcionados en nuestro sitio web.</p>

  <p>Gracias por utilizar ReTradeX. Esperamos que disfrutes de nuestra plataforma y obtengas una experiencia enriquecedora mientras navegas, compras y participas en nuestra comunidad en línea.</p>

  </div>

    <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
<?php echo $footer; ?>
    </body>
</html>