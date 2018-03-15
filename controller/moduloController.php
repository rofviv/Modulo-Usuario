<?php

if (isset($_SESSION['app_id'])) {
  include(VIEW_DIR . 'moduloView.php');
} else {
  header('location: ?view=login');
}

?>
