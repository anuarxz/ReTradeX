<?php

try {
    $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4");
    $dsn = "mysql:host=localhost;dbname=ReTradeX";
    $dwes = new PDO($dsn, "ReTradeX", "ReTradeX", $opc);
}
catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$footer = "<div class='container'>
            <footer class='d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top'>
            <p class='col-md-4 mb-0 text-muted'>&copy; 2023 ReTradeX, S.L.</p>

            <a href='index.php' class='col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none'>
            <img class='img-fluid' src='../Imagenes/logo.png' height='55px' width='55px'>
            </a>

            <ul class='nav col-md-4 justify-content-end'>
                <li class='nav-item'><a href='terminos.php' class='nav-link px-2 text-muted'>Términos</a></li>
                <li class='nav-item'><a href='privacidad.php' class='nav-link px-2 text-muted'>Política de privacidad</a></li>
                <li class='nav-item'><a href='contacto.php' class='nav-link px-2 text-muted'>Contacto</a></li>
            </ul>
            </footer>
            </div>";
?>