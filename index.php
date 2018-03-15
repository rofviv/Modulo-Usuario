<?php

require('core.php');

if (isset($_GET['view'])) {
  if (file_exists('controller/' . strtolower($_GET['view']) . 'Controller.php')) {
    include('controller/' . strtolower($_GET['view']) . 'Controller.php');
  } else {
    include('controller/errorController.php');
  }
} else {
  include('controller/loginController.php');
}

?>
