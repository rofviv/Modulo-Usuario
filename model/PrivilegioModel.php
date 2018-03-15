<?php

class Privilegio {

  public function listar() {
    $db = new Conexion();
    $id = $_SESSION['app_id'];
    $result = $db->query("SELECT m.opcion, m.enlace, m.icon FROM menu AS m INNER JOIN menu_usuario AS mu ON m.id = mu.id_menu INNER JOIN usuario AS u ON u.id = mu.id_usuario WHERE u.id = $id;");
    $resultados = array();
    if ($db->rows($result) > 0) {
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          $resultados[] = $row;
      }
    } else {
      return "Sin resultados";
    }
    $db->liberar($result);
    $db->close();
    return $resultados;
  }

  public function nuevo_grupo($_grupo) {
    $db = new Conexion();
    $bitacora = new Bitacora();
    $grupo = $db->real_escape_string($_grupo);
    $id = $_SESSION['app_id'];
    $result = $db->query("INSERT INTO grupo_usuario (grupo) VALUES ('$grupo');");
    if ($result) {
      $bitacora->registrar('Registro nuevo Grupo ' . $grupo);
      $result = '1';
    } else {
      $result = 'No Registrado';
    }
    $db->close();
    return $result;
  }

  public function nuevo_privilegio($o, $e, $i, $id_g) {
    $db = new Conexion();
    $bitacora = new Bitacora();
    $result = $db->query("INSERT INTO menu (opcion, enlace, icon, id_grupo) VALUES ('$o', '$e', '$i', '$id_g');");
    if ($result) {
      $bitacora->registrar('Registro nuevo Privilegio ' . $o);
      $result = '1';
    } else {
      $result = 'No Registrado';
    }
    $db->close();
    return $result;
  }

  public function grupos() {
    $db = new Conexion();
    $id = $_SESSION['app_id'];
    $result = $db->query("SELECT id, grupo FROM grupo_usuario;");
    $resultados = array();
    if ($db->rows($result) > 0) {
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          $resultados[] = $row;
      }
    } else {
      return "Sin resultados";
    }
    $db->liberar($result);
    $db->close();
    return $resultados;
  }

  public function privilegios_grupo($id_g) {
    $db = new Conexion();
    $result = $db->query("SELECT m.id, m.opcion, m.icon FROM menu AS m INNER JOIN grupo_usuario AS gu ON m.id_grupo = gu.id WHERE gu.id = $id_g;");
    $resultados = array();
    if ($db->rows($result) > 0) {
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          $resultados[] = $row;
      }
    } else {
      $resultados = null;
    }
    $db->liberar($result);
    $db->close();
    return $resultados;
  }

  public function eliminar_privilegio($id_p) {
    $db = new Conexion();
    $bitacora = new Bitacora();
    $sql = $db->query("DELETE FROM menu_usuario WHERE id_menu = $id_p");
    if ($sql) {
      $sql3 = $db->query("DELETE FROM menu WHERE id = $id_p;");
      $bitacora->registrar('Elimino un privilegio');
      $result = '1';
    } else {
      $result = 'No Registrado';
    }
    $db->close();
    return $result;
  }

  public function detalle_privilegio($id) {
    $db = new Conexion();
    $result = $db->query("SELECT m.id, m.opcion, m.enlace, m.icon, m.id_grupo FROM menu AS m WHERE m.id = $id;");
    $resultados = array();
    if ($db->rows($result) > 0) {
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          $resultados[] = $row;
      }
    } else {
      $resultados = null;
    }
    $db->liberar($result);
    $db->close();
    return $resultados;
  }

  public function actualizar_privilegio($id_p, $_op, $_ic, $_en) {
    $db = new Conexion();
    $bitacora = new Bitacora();
    $sql = $db->query("UPDATE menu SET opcion = '$_op', icon = '$_ic', enlace = '$_en' WHERE id = $id_p;");
    if ($sql) {
      $bitacora->registrar('Actualizo un privilegio');
      $result = '1';
    } else {
      $result = '0';
    }
    $db->close();
    return $result;
  }
}

?>
