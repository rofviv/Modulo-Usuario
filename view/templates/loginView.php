<?php include('view/complement/head.php'); ?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <span ><b><?php echo APP_TITLE ?></b></span>
  </div>

  <div class="login-box-body">
    <p class="login-box-msg">iniciar Sesión</p>

    <div role="form" onkeypress="fun_login(event)" >
      <div class="form-group has-feedback">
        <input id="user_login" type="text" class="form-control" placeholder="Usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="pass_login" type="password" class="form-control" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="button" class="btn btn-primary btn-block btn-flat" onclick="goLogin()" >Ingresar</button>
        </div>
      </div>
    </div>
    <br>
    <div id="_AJAX_LOGIN" ></div>
  </div>
</div>
<script src="includes/js/jquery.min.js"></script>
<script src="includes/js/bootstrap.min.js"></script>
<script type="text/javascript" src="includes/js/ajax/login.js"></script>
</body>
</html>
