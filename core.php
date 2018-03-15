<?php
session_start();
date_default_timezone_set('Etc/GMT+4');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'usuario');

define('VIEW_DIR', 'view/templates/');
define('APP_URL', 'http://localhost/ModuloSeguridad/');
define('APP_TITLE', 'Modulo de Seguridad');
define('APP_TITLE_MIN', 'MS');
define('APP_COPY', 'Copyright &copy; ' . date('Y', time()) . ' ' . APP_TITLE . ' Software.');

require('model/Conexion.php');
require('model/PrivilegioModel.php');
require('model/BitacoraModel.php');
//require('includes/functions/Usuario.php');

//$_USER = Users();

?>
