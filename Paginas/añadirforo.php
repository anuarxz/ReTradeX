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
        <li class="nav-item"><a href="adminforo.php" class="nav-link px-2 link-dark active">Foro</a></li>
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

include "global.php";

          if (isset($_POST['añadir'])) {
            date_default_timezone_set('Europe/Madrid');
            $fechaHoraActual = date('Y-m-d H:i:s');
          
            $titulo = $_REQUEST['titulo'];
            $descripcion = $_REQUEST['descripcion'];
            $icono = $_REQUEST['icono'];

            
                    $sql = "INSERT INTO Foro(Fecha, Titulo, Descripcion, Icono) VALUES  
                    ('$fechaHoraActual', '$titulo', '$descripcion', '$icono');";

                    $dwes->query($sql);
            
                    unset($dwes);
            
                      echo "<div class='px-4 py-5 my-5 text-center'>
                      <img class='d-block mx-auto mb-4' src='../Imagenes/logo.png' alt='' width='72' height='57'>
                      <h1 class='display-5 fw-bold'>¡Genial!</h1>
                      <div class='col-lg-6 mx-auto'>
                        <p class='lead mb-4'>Se ha añadido correctamente</p>
                        <div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>
                          <a href='adminforo.php'><button type='button' class='btn btn-primary btn-lg px-4 gap-3'>Ver foro</button></a>
                        </div>
                      </div>
                    </div>";
                    }
                      else {
          ?>
      
      <div class="container-md mt-2">
        <h2 class="text-center py-4">Foro - Nuevo tema</h2>    

        <form class="row g-3 needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" ENCTYPE="multipart/form-data" novalidate>
        <div class="col-md-10">
          <label for="validationCustom01" class="form-label">Título</label>
          <input type="text" class="form-control" id="validationCustom01" name="titulo" required>
        </div>

        <div class="col-md-2">
          <label class="form-label">Icono</label>
          <div class="input-group">
            <span class="input-group-text">😀</span>
            <select class="form-control" name="icono">
                <option value="😀" selected>😀</option>
                <option value="😃">😃</option>
                <option value="😄">😄</option>
                <option value="😊">😊</option>
                <option value="😉">😉</option>
                <option value="😍">😍</option>
                <option value="😘">😘</option>
                <option value="😎">😎</option>
                <option value="😂">😂</option>
                <option value="😭">😭</option>
                <option value="🤔">🤔</option>
                <option value="😐">😐</option>
                <option value="😢">😢</option>
                <option value="😡">😡</option>
                <option value="🤯">🤯</option>
                <option value="🤩">🤩</option>
                <option value="🥳">🥳</option>
                <option value="🤗">🤗</option>
                <option value="🙏">🙏</option>
                <option value="👍">👍</option>
                <option value="👎">👎</option>
                <option value="👌">👌</option>
                <option value="✌️">✌️</option>
                <option value="👏">👏</option>
                <option value="🔥">🔥</option>
                <option value="💯">💯</option>
                <option value="❤️">❤️</option>
                <option value="💔">💔</option>
                <option value="💪">💪</option>
                <option value="🌟">🌟</option>
                <option value="⭐️">⭐️</option>
                <option value="🌈">🌈</option>
                <option value="🍀">🍀</option>
                <option value="🌺">🌺</option>
                <option value="🌼">🌼</option>
                <option value="🍔">🍔</option>
                <option value="🍕">🍕</option>
                <option value="🍎">🍎</option>
                <option value="🍓">🍓</option>
                <option value="🍦">🍦</option>
                <option value="🍩">🍩</option>
                <option value="🎂">🎂</option>
                <option value="🍺">🍺</option>
                <option value="🍷">🍷</option>
                <option value="🎉">🎉</option>
                <option value="🎈">🎈</option>
                <option value="🎁">🎁</option>
                <option value="📚">📚</option>
                <option value="💻">💻</option>
                <option value="🎮">🎮</option>
                <option value="🎸">🎸</option>
                <option value="🎤">🎤</option>
                <option value="🎨">🎨</option>
                <option value="⌛️">⌛️</option>
                <option value="⏰">⏰</option>
                <option value="🔍">🔍</option>
                <option value="💡">💡</option>
                <option value="✉️">✉️</option>
                <option value="📷">📷</option>
                <option value="🎥">🎥</option>
                <option value="💣">💣</option>
                </select>
        </div>
        </div>
        
        <div class="col-md-12">
          <label for="validationCustom02" class="form-label">Descripción</label>
          <input type="text" class="form-control" id="validationCustom02" name="descripcion" required>
        </div>
        


<div class="col-12 d-flex justify-content-center py-5">
  <button class="btn btn-primary" name="añadir" type="submit">Añadir nuevo tema</button>
</div>

      </form>
        
<script>
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

        <?php
    }
    ?>
  

      </div>


<br>
      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
      <?php echo $footer; ?>
</body>
</html>