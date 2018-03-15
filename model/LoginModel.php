<?php

class Login {

  public function nueva_sesion($user, $pass) {
    $db = new Conexion();
    $usuario = $db->real_escape_string($user);
    $clave = $db->real_escape_string($pass);
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $sql = $db->query("SELECT id FROM usuario WHERE usuario='$usuario' AND clave='$clave' AND activo=1 LIMIT 1;");

    if ($db->rows($sql) > 0) {
      $_SESSION['app_id'] = $db->recorrer($sql)[0];
      $id = $_SESSION['app_id'];
      $sql2 = $db->query("INSERT INTO bitacora (suceso, fecha, hora, id_usuario) VALUES
        ('Accedio al sistema', '$fecha', '$hora', $id);");
      $db->liberar($sql);
      $db->close();
      return '1';
    } else {
      return 'No encontrado';
    }
  }

  public function cerrar_sesion() {
    $db = new Conexion();
    $id = $_SESSION['app_id'];
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $sql = $db->query("INSERT INTO bitacora (suceso, fecha, hora, id_usuario) VALUES
      ('Salió del sistema', '$fecha', '$hora', $id);");
    $db->close();
    session_destroy();
    session_unset();
  }
}

?>
