<?php

if (isset($_SESSION['app_id'])) {
  include(VIEW_DIR . 'bitacoraView.php');
} else {
  header('location: ?view=login');
}

?>
