<?php

if (isset($_SESSION['app_id'])) {
  require('model/LoginModel.php');
  $login = new Login();
  $login->cerrar_sesion();
}

header('location: ?view=login');

?>
