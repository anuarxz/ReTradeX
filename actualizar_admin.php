<?php
include "global.php";

if (isset($_POST['id'])) {//Comprobamos si se ha enviado el id
  $id = $_POST['id'];//Recogemos el id
  $estado = $_POST['estado'];//Recogemos el estado

  //Dependiendo del estado actualizamos el Admin de una forma u otra
  if($estado==1){
    $sql = "UPDATE Clientes SET Admin = 1 WHERE IdCliente = $id";
    $dwes->query($sql);
    unset($dwes);
  }else{
    $sql = "UPDATE Clientes SET Admin = 0 WHERE IdCliente = $id";
    $dwes->query($sql);
    unset($dwes);
  }

}
?>
