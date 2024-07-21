<?php
include "global.php";

    // Comprobamos si ya se ha enviado el formulario
    if (isset($_POST['enviar'])) {
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        
       
        if (empty($correo) || empty($password))
            $error = "Debes introducir un correo y una contraseña";
        else {
            // Comprobamos las credenciales con la base de datos
            // Conectamos a la base de datos
             // Ejecutamos la consulta para comprobar las credenciales
            $sql = "SELECT Nombre FROM Clientes " .
            "WHERE Correo='$correo' " .
            "AND Clave='" . md5($password) . "'";
            
            if($resultado = $dwes->query($sql)) {
                $fila = $resultado->fetch();
                if ($fila != null) {
                    session_start();
                    $_SESSION['correo']=$correo;

                      $sql2 = "SELECT * FROM Clientes WHERE Correo = '$correo'";
                      $resultado2 = $dwes->query($sql2);
                      $row2 = $resultado2->fetch();
                      while ($row2 != null) {    
                        $_SESSION['IdCliente'] = $row2['IdCliente'];

                        if (!isset($error)) {
                          $sql = "SELECT * FROM Clientes WHERE IdCliente = ". $_SESSION['IdCliente'] ."";
                          $resultado = $dwes->query($sql);
                          $row = $resultado->fetch();
                          while ($row != null) {
                            $_SESSION['Nombre'] = $row['Nombre'];
                            $_SESSION['Apellido'] = $row['Apellido'];
                            $_SESSION['Apodo'] = $row['Apodo'];
                            $_SESSION['Direccion'] = $row["Direccion"];
                            $_SESSION['Pais'] = $row["Pais"];
                            $_SESSION['CP'] = $row["CP"];
                            $_SESSION['Correo'] = $row["Correo"];
                            $_SESSION['DNI'] = $row["DNI"];
                            $_SESSION['Telefono'] = $row["Telefono"];
                            $_SESSION['Clave'] = $row["Clave"];
                            $_SESSION['Saldo'] = $row["Saldo"];
                            $_SESSION['Admin'] = $row["Admin"];

                      
                            $row = $resultado->fetch();
                          }
                      }

                        $row2 = $resultado2->fetch();
                      }


                    if($_SESSION['Admin']==1)
                    {
                      header("Location: admin.php");
                    }else{
                    header("Location: index.php");}                    
                }
                else {
                    // Si las credenciales no son válidas, se vuelven a pedir
                    $error = "¡Correo o contraseña no válidos!";
                }
                unset($resultado);
            }
            unset($dwes);            
        }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReTradeX - Iniciar Sesión</title>
    <link rel="icon" type="image/jpg" href="../Imagenes/logo.png"/>
    <link rel="stylesheet" href="../Estilos/style.css">
    <style>
    html,body {height: 100%;}
    .error{color: red;}
    .form-signin {max-width: 330px;padding: 15px; }
    .form-signin .form-floating:focus-within {z-index: 2;}
    .form-signin input[type="email"] {margin-bottom: -1px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;}
    .form-signin input[type="password"] {margin-bottom: 10px; border-top-left-radius: 0;border-top-right-radius: 0;}
</style>
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
    </header>
  </div>


  <main class="form-signin w-100 m-auto text-center pb-5 py-5 mt-5 mb-5">
  <form action='<?php echo $_SERVER['PHP_SELF'];?>' method='post'>
      <img class="mb-4" src="../Imagenes/logo.png" alt="" width="90" height="75">
      <h1 class="h3 mb-3 fw-normal">Iniciar Sesión</h1>
  
      <div class="form-floating">
        <input type="email" class="form-control" name='correo' id='correo' placeholder="name@example.com">
        <label for="floatingInput">E-mail</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name='password' id='password' placeholder="Password">
        <label for="floatingPassword">Contraseña</label>
        <span class='error'><?php if (isset($error)) echo $error; ?></span>
        </span>
      </div>
  
      <div class="checkbox mb-3">
      <a href="registro.php">¿No estás registrado? Regístrate ahora</a>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit" name='enviar'>Iniciar Sesión</button>
    </form>
  </main>




      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>
      <?php echo $footer; ?>
</body>
</html>