<?php

if (isset($_SESSION['app_id'])) {
  if (isset($_GET['tipo'])) {
    switch ($_GET['tipo']) {
      case 'obtener':
        obtenerPrivilegios();
        break;
      case 'eliminar':
        eliminarPrivilegio();
        break;
      case 'detalle':
        detallePrivilegio();
        break;
      case 'actualizar':
        actualizarPrivilegio();
        break;
      default:

        break;
    }
  } else {
    include(VIEW_DIR . 'privilegiosView.php');
  }

} else {
  header('location: ?view=login');
}

function obtenerPrivilegios() {
  $privilegios = new Privilegio();
  $result = $privilegios->privilegios_grupo($_GET['id']);
  if ($result != null) {
    echo json_encode($result);
  } else {
    echo '0';
  }
}

function eliminarPrivilegio() {
  $privilegios = new Privilegio();
  $result = $privilegios->eliminar_privilegio($_GET['id']);
  if ($result != null) {
    echo $result;
  } else {
    echo '0';
  }
}

function detallePrivilegio() {
  $privilegios = new Privilegio();
  $result = $privilegios->detalle_privilegio($_GET['id']);
  if ($result != null) {
    echo json_encode($result);
  } else {
    echo '0';
  }
}

function actualizarPrivilegio() {
  $privilegios = new Privilegio();
  $result = $privilegios->actualizar_privilegio($_GET['id'], $_GET['o'], $_GET['i'], $_GET['e']);
  if ($result != null) {
    echo $result;
  } else {
    echo $result;
  }
}

?>
