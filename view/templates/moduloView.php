<?php include('view/complement/head.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include('view/complement/nav.php'); ?>

  <?php include('view/complement/sidebar.php'); ?>

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Nuevo Módulo
        <small>Crear un nuevo modulo</small>
      </h1>
    </section>

    <section class="content container-fluid">

      <div class="col-md-4">

        <div class="register-box" onclick="eliminarAlerta()">

          <div class="register-box-body">
            <p class="login-box-msg">Registrar Nuevo Modulo</p>

            <div role="form" onkeypress="fun_register(event)">
              <div class="form-group has-feedback">
                <input id="modulo_reg" type="text" class="form-control" placeholder="Modulo">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <button type="button" id="registrar_btn" class="btn btn-primary btn-block btn-flat" onclick="registrarModulo()" >Guardar</button>
              </div>
            </div>
            <br>

            <div id="_AJAX_REG_"></div>

          </div>
        </div>
      </div>

    </section>

  </div>

  <?php include('view/complement/footer.php'); ?>
  <script type="text/javascript" src="includes/js/ajax/registrarModulo.js"></script>
</div>

</body>
</html>
