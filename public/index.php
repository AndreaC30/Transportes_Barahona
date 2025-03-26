<!-- Fichero principal, es el punto de entrada de la aplicacion-->
<?php

require_once __DIR__ . '/../app/core/Router.php';

/*Instancia la clase Router, el cual es el encargador de controlar 
que accion debe ejecutarse a traves del URL*/
$router = new Router();
//Llama al metodo para procesar la solicitud
$router->route();
?>