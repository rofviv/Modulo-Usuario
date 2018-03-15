<?php

if (!isset($_SESSION['app_id'])) {
  header('location: ?view=login');
}

if (isset($_GET['tipo'])) {
  switch ($_GET['tipo']) {
    case 'usuario':
      nuevo_usuario();
      break;
    case 'modulo':
      nuevo_modulo();
      break;
    case 'privilegio':
      nuevo_privilegio();
      break;
    default:
      # code...
      break;
  }
} else {
    include(VIEW_DIR . 'registrarView.php');
}

function nuevo_usuario() {
  require('model/UsuarioModel.php');
  $usuario = new Usuario();
  $nombre = $_POST['n'];
  $user = $_POST['u'];
  $pass = $_POST['p'];
  $data = json_decode($_POST['priv']);

  $result = $usuario->nuevo_usuario($nombre, $user, $pass, $data);
  echo $result;
}

function nuevo_modulo() {
  $privilegio = new Privilegio();
  $modulo = $_GET['m'];
  $result = $privilegio->nuevo_grupo($modulo);
  echo $result;
}

function nuevo_privilegio() {
  $privilegio = new Privilegio();
  $result = $privilegio->nuevo_privilegio($_GET['o'], $_GET['e'], $_GET['i'], $_GET['id_g']);
  echo $result;
}

?>
