<?php

class Bitacora{

  public function listar() {
    $db = new Conexion();
    $result = $db->query("SELECT b.suceso, b.fecha, b.hora, u.nombre FROM bitacora AS b INNER JOIN usuario AS u ON b.id_usuario = u.id ORDER BY b.fecha, b.hora DESC;");
    $resultados = array();
    if ($db->rows($result) > 0) {
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          $resultados[] = $row;
      }
      return $resultados;
    } else {
      return "Sin resultados";
    }
    $db->liberar($result);
    $db->close();
  }

  public function registrar($suceso) {
    $db = new Conexion();
    $id_u = $_SESSION['app_id'];
    $fecha = date('Y-m-d');
    $hora = date('H:i:s');
    $sql = $db->query("INSERT INTO bitacora (suceso, fecha, hora, id_usuario) VALUES
      ('$suceso', '$fecha', '$hora', $id_u);");
    $db->close();
  }
}

?>
