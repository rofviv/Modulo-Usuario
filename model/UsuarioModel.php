<?php

class Usuario {

  public function nuevo_usuario($_nombre, $_usuario, $_clave, $_data) {
    $db = new Conexion();
    $bitacora = new Bitacora();
    $nombre = $db->real_escape_string($_nombre);
    $usuario = $db->real_escape_string($_usuario);
    $clave = $db->real_escape_string($_clave);
    $id = $_SESSION['app_id'];
    $sql = $db->query("INSERT INTO usuario (nombre, usuario, clave) VALUES ('$nombre', '$usuario', '$clave');");
    $r = $db->query("SELECT id FROM usuario WHERE usuario='$usuario' LIMIT 1;");
    if ($db->rows($r) > 0) {
      $id_u = $db->recorrer($r)[0];
      foreach ($_data as $data) {
        $s = $db->query("INSERT INTO menu_usuario (id_usuario, id_menu) VALUES ($id_u, $data);");
      }
    }

    if ($sql) {
      $bitacora->registrar('Registro a ' . $nombre);
      $result = '1';
    } else {
      $result = 'No Registrado';
    }
    $db->close();
    return $result;
  }
}

?>
