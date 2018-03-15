<?php include('view/complement/head.php'); ?>
<?php
  $grupo_usuario = new Privilegio();
  $grupos = $grupo_usuario->grupos();
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include('view/complement/nav.php'); ?>

  <?php include('view/complement/sidebar.php'); ?>

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Registrar
        <small>Nuevo Usuario</small>
      </h1>
    </section>

    <section class="content container-fluid">
      <div class="col-md-4">

        <div class="register-box" onclick="eliminarAlerta()">

          <div class="register-box-body">
            <p class="login-box-msg">Registrar un Nuevo Usuario</p>

            <div role="form" onkeypress="fun_register(event)">
              <div class="form-group has-feedback">
                <input id="nombre_reg" type="text" class="form-control" placeholder="Nombre">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input id="usuario_reg" type="text" class="form-control" placeholder="Usuario">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input id="clave_reg" type="password" class="form-control" placeholder="Contraseña">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input id="clave2_reg" type="password" class="form-control" placeholder="Repetir Contraseña">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
              </div>

            </div>
            <br>

            <div id="_AJAX_REG_"></div>

          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="register-box">
          <div class="register-box-body">
            <p class="login-box-msg">Seleccionar Grupo de Usuario</p>
            <?php foreach ($grupos as $g): ?>
              <div class="row" style="margin-bottom:10px;">
                <div class="col-md-12">
                  <button type="button" class="btn btn-primary btn-block btn-flat" onclick="cargarPrivilegios(<?php echo $g['id']; ?>)" ><?php echo $g['grupo'] . ' <i class="fa fa-arrow-circle-right"></i>' ?></button>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="register-box">
          <div class="register-box-body">
            <p class="login-box-msg">Seleccionar Privilegios</p>
            <div id="_div_privilegios">No se ha seleccionado un grupo.</div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <button type="button" id="registrar_btn" class="btn btn-primary btn-block btn-flat" onclick="registrarUsuario()" disabled>Registrar</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

  </div>

  <?php include('view/complement/footer.php'); ?>

</div>
<script type="text/javascript" src="includes/js/ajax/registrarUsuario.js"></script>

</body>
</html>
