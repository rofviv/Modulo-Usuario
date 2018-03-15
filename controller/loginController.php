<?php

if (isset($_SESSION['app_id'])) {
  header('location: ?view=principal');
}

if ($_POST) {
  if (isset($_GET['mode'])) {
    iniciarSesion();
  }
} else {
  include(VIEW_DIR . 'loginView.php');
}

function iniciarSesion() {
  require('model/LoginModel.php');
  $login = new Login();
  $user = $_POST['u'];
  $pass = $_POST['p'];

  $result = $login->nueva_sesion($user, $pass);
  echo $result;
}

?>
