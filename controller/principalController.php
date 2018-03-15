<?php

if (isset($_SESSION['app_id'])) {
  include(VIEW_DIR . 'principalView.php');
} else {
  header('location: ?view=login');
}

?>
