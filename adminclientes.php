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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <li class="nav-item"><a href="adminclientes.php" class="nav-link px-2 link-dark active">Clientes</a></li>
        <li class="nav-item"><a href="adminnoticias.php" class="nav-link px-2 link-dark">Noticias</a></li>
        <li class="nav-item"><a href="adminforo.php" class="nav-link px-2 link-dark">Foro</a></li>
        <li class="nav-item"><a href="admintienda.php" class="nav-link px-2 link-dark">Tienda</a></li>
      </ul>
      <div class="col-md-3 text-end">
        <a href="cerrarsesion.php"><button type="button" class="btn btn-outline-primary me-2 m-1">Cerrar Sesión</button></a>
      </div>
    </header>
  </div>

  
  <div class="container px-3 mt-5" id="custom-cards">
  <div class="row align-items-center">
      <div class="col">
        <h1 class="d-inline">Clientes</h1>
      </div>
    </div>
  </div>


 
<?php
    if (isset($_POST['eliminar'])) {//comprobamos si se ha enviado
        $sql1 = 'DELETE FROM Clientes WHERE IdCliente=' . $_REQUEST["idborrar"];//ejecutamos la consulta para eliminarlo
        $resultado1 = $dwes->query($sql1);
    }


    if (!isset($error)) {
        $sql = "SELECT  * FROM Clientes ORDER BY IdCliente DESC";//obtenemos todos los clientes
        $resultado = $dwes->query($sql);
        if ($resultado) {

            $row = $resultado->fetch();
            echo " <div class='container px-4 py-5' id='custom-cards'>
                        <div class='align-items-stretch g-4 py-3'>";

            while ($row != null) {
                $id = $row['IdCliente'];
                $nombre = $row['Nombre'];
                $apellido = $row['Apellido'];
                $apodo = $row['Apodo'];
                $direccion = $row['Direccion'];
                $pais = $row['Pais'];
                $cp = $row['CP'];
                $dni = $row['DNI'];
                $correo = $row['Correo'];
                $telefono = $row['Telefono'];
                $admin = $row['Admin'];

                if($admin==1){
                    $admin = "checked";
                }else{
                    $admin = "";
                }

                if($id!=$_SESSION['IdCliente'] && $id!=1){//nos saltamos nuestro cliente y el admin principal
                echo "<div class='col pt-2'>
                <div class='card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg' style='background-image: url();'>
                    <div class='d-flex flex-column h-100 p-5 pb-3 text-black text-shadow-1'>
                        <div class='d-flex justify-content-between align-items-center mb-4'>
                            <h3 class='mt-2 display-6 lh-1 fw-bold'>$nombre</h3>
                            <div class='form-check form-switch ms-3'>
                                <input class='form-check-input' type='checkbox' data-id='$id' onchange='actualizarEstado(this)' $admin>
                                <label class='form-check-label'>Admin</label>
                            </div>
                        </div>
                        <ul class='d-flex list-unstyled mt-auto'>
                            <li class='me-auto'>
                                <b>IdCliente:</b> $id <b>Nombre:</b> $nombre <b>Apellido:</b> $apellido <b>Correo:</b> $correo <b>Apodo:</b> $apodo <b>DNI:</b> $dni <b>Telefono:</b> $telefono
                            </li>
                            <li class='d-flex align-items-center me-2'>
                                <form name='input' action='adminclientes.php' method='post' enctype='multipart/form-data'>
                                    <input type='hidden' name='idborrar' value='$id'>
                                    <button type='submit' name='eliminar' class='btn btn-danger'>Eliminar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>";
                }
                
                $row = $resultado->fetch();
            }
            echo " </div></div>";
        }
    }
?>

<script>
  function actualizarEstado(checkbox) {
    var id = $(checkbox).data('id');//obtenemos el id
    var estado = checkbox.checked ? 1 : 0;//recogemos si esta checkeado

    $.ajax({
      url: 'actualizar_admin.php',
      type: 'POST',
      data: { id: id, estado: estado },//enviamos los datos mediante ajax al archivo de actualizar admin
      success: function(response) {
        // Actualización exitosa
        console.log('Estado actualizado en la base de datos');
      },
      error: function() {
        // Error al actualizar el estado
        console.log('Error al actualizar el estado en la base de datos');
      }
    });
  }
</script>

      <script src="../Estilos/node_modules/bootstrap/dist/js/bootstrap.js"></script>

<?php echo $footer; ?>
    </body>
</html>